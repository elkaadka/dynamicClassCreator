<?php

namespace Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\CodingStyle\Psr2;
use Kanel\Enuma\Component\Constant;
use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Helper\ClassNameExtractor;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Helper\ValuePrinter;

class ClassCreator
{
    use ClassNameExtractor;
    use CommentGeneration;
    use ValuePrinter;

    const ABSTRACT = 'abstract';
    const FINAL = 'final';

    const NAMESPACE_SECTION = 1;
    const USE_SECTION = 2;
    const CLASS_COMMENT_SECTION = 3;
    const CLASS_FINAL_ABSTRACT_SECTION = 4;
    const CLASS_NAME = 5;
    const CLASS_TYPE_SECTION = 6;
    const CLASS_EXTENDS_SECTION = 7;
    const CLASS_IMPLEMENTS_SECTION = 8;
    const CLASS_IMPLEMENTED_CLASSES_SECTION = 9;
    const TRAIT_SECTION = 11;
    const CONST_SECTION = 12;
    const PROPERTIES_SECTION = 13;
    const METHODS_SECTION = 14;
    const CLASS_END_SECTION = 15;
    const LINE_FEED = 16;
    const PHP_CLOSE_TAG_SECTION0 = 17;

    protected $sections = [];
    protected $codingStyle;

    protected $namespace;
    protected $use = [];
    protected $functions = [];
    protected $isAbstract;
    protected $traits = [];
    protected $properties = [];
    protected $isFinal = false;

    public function __construct(CodingStyle $codingStyle = null)
    {
        $this->codingStyle = $codingStyle ?? new Psr2();
        $this->sections = [
            static::NAMESPACE_SECTION => '',
            static::USE_SECTION => [],
            static::CLASS_COMMENT_SECTION => '',
            static::CLASS_FINAL_ABSTRACT_SECTION => '',
            static::CLASS_TYPE_SECTION => '',
            static::CLASS_NAME => '',
            static::CLASS_EXTENDS_SECTION => '',
            static::CLASS_IMPLEMENTS_SECTION => '',
            static::CLASS_IMPLEMENTED_CLASSES_SECTION => [],
            static::TRAIT_SECTION => [],
            static::CONST_SECTION => [],
            static::PROPERTIES_SECTION => [],
            static::METHODS_SECTION => [],
            static::CLASS_END_SECTION => '}',
            static::LINE_FEED => '',
            static::PHP_CLOSE_TAG_SECTION0 => '?>',
        ];
    }

    public function getCodingStyle(): CodingStyle
    {
        return $this->codingStyle;
    }

    public function namespace(string $namespace)
    {
        $this->sections[static::NAMESPACE_SECTION] = "namespace $namespace;";

        return $this;
    }

    public function use(string...$classes)
    {
        foreach ($classes as $class) {
            $this->sections[static::USE_SECTION][$class] = "use $class;";
        }

        return $this;
    }

    public function abstract()
    {
        $this->sections[static::CLASS_FINAL_ABSTRACT_SECTION] = 'abstract ';

        return $this;
    }

    public function final()
    {
        $this->sections[static::CLASS_FINAL_ABSTRACT_SECTION] = 'final ';

        return $this;
    }

    public function class(string $name)
    {
        $this->sections[static::CLASS_TYPE_SECTION] = 'class';
        $this->sections[static::CLASS_NAME] = $name;

        return $this;
    }

    public function extends(string $className)
    {
        list($namespace, $class) = $this->extractType($className);

        if ($namespace) {
            $this->use($namespace);
        }

        $this->sections[static::CLASS_EXTENDS_SECTION] = "extends $class";

        return $this;
    }

    public function implements(string...$interfaces)
    {
        $this->sections[static::CLASS_IMPLEMENTS_SECTION] = 'implements';

        foreach ($interfaces as $interface) {
            list($namespace, $class) = $this->extractType($interface);

            if ($namespace) {
                $this->use($namespace);
            }

            $this->sections[static::CLASS_IMPLEMENTED_CLASSES_SECTION][] =  $class;
        }

        return $this;
    }

    public function comment(string $comment)
    {
        $this->sections[static::CLASS_COMMENT_SECTION] = $this->generateDocComment($comment, '', $this->codingStyle->getNewLine());

        return $this;
    }

    public function useTraits(string...$traits)
    {
        foreach ($traits as $trait) {
            list($namespace, $trait) = $this->extractType($trait);

            if ($namespace) {
                $this->use($namespace);
            }

            $this->sections[static::TRAIT_SECTION][] = "use $trait;";
        }

        return $this;
    }

    public function addConst(Constant $const)
    {
        $this->sections[static::CONST_SECTION][] = $const;

        return $this;
    }

    public function addProperty(Property $property)
    {
        $this->sections[static::PROPERTIES_SECTION][] = $property;

        return $this;
    }

    public function addFunction(Method $function)
    {
        $this->sections[static::METHODS_SECTION][] = $function;

        return $this;
    }

    public function toString() : string
    {
        $classContent = '';

        if ( $this->sections[static::CLASS_NAME]) {
            $classContent .= rtrim(
                $this->sections[static::CLASS_COMMENT_SECTION]
                . rtrim(
                    $this->sections[static::CLASS_FINAL_ABSTRACT_SECTION]
                    . $this->sections[static::CLASS_TYPE_SECTION] . ' '
                    . $this->sections[static::CLASS_NAME] . ' '
                    . $this->sections[static::CLASS_EXTENDS_SECTION]
                    . ($this->sections[static::CLASS_EXTENDS_SECTION] ? ' ' : '')
                    . $this->sections[static::CLASS_IMPLEMENTS_SECTION]
                    . ($this->sections[static::CLASS_IMPLEMENTS_SECTION] ? ' ' : '')
                    . implode(', ', $this->sections[static::CLASS_IMPLEMENTED_CLASSES_SECTION])
                )
                . ($this->codingStyle->isClassBracesInNewLine()? $this->codingStyle->getNewLine() : "")
                . '{'
            );

            if ($this->sections[static::TRAIT_SECTION]) {
                $classContent .= $this->codingStyle->getNewLine()
                    . $this->codingStyle->getIndentation()
                    . implode(
                        $this->codingStyle->getNewLine() . $this->codingStyle->getIndentation(),
                        $this->sections[static::TRAIT_SECTION]
                    )
                    . $this->codingStyle->getNewLine()
                ;
            }

            if ($this->sections[static::CONST_SECTION]) {
                $classContent .= rtrim(
                    $this->codingStyle->getNewLine()
                    . array_reduce(
                        $this->sections[static::CONST_SECTION],
                        function($carry, $const) {

                            $comment = $this->generateDocComment(
                                $const->getComment(),
                                $this->codingStyle->getIndentation(),
                                $this->codingStyle->getNewLine()
                            );

                            //if there are comments in the second const (or above) add an extra new line between constants
                            if (!empty($carry) && $comment) {
                                $comment = $this->codingStyle->getNewLine() . $comment;
                            }


                            $carry .=  $comment
                                . $this->codingStyle->getIndentation()
                                . ($const->getVisibility()? $const->getVisibility() . ' ' : '')
                                . 'const ' . $const->getName()
                                . ' = ' . $this->printValue($const->getValue())
                                . ';'
                                . $this->codingStyle->getNewLine()
                            ;

                            return $carry;
                        },
                        ''
                    )
                ) . $this->codingStyle->getNewLine();
            }

            if ($this->sections[static::PROPERTIES_SECTION]) {
                $classContent .= rtrim(
                    $this->codingStyle->getNewLine()
                    . array_reduce(
                        $this->sections[static::PROPERTIES_SECTION],
                        function($carry, $property) {

                            $comment = $this->generateDocComment(
                                $property->getComment(),
                                $this->codingStyle->getIndentation(),
                                $this->codingStyle->getNewLine()
                            );

                            //if there are comments in the second const (or above) add an extra new line between constants
                            if (!empty($carry) && $comment) {
                                $comment = $this->codingStyle->getNewLine() . $comment;
                            }

                            $carry .= $comment
                            . $this->codingStyle->getIndentation()
                            . ($property->getVisibility()? $property->getVisibility() . ' ' : '')
                            . ($property->isStatic() ? 'static ' : '')
                            . '$' . $property->getName()
                            . ($property->getValue() ? ' = ' . $this->printValue($property->getValue()) : '')
                            . ';'
                            . $this->codingStyle->getNewLine()
                            ;

                            return $carry;
                        },
                        ''
                    )
                );
            }

            if($this->sections[static::METHODS_SECTION]) {


                $classContent .= $this->codingStyle->getNewLine()
                    . rtrim(
                        array_reduce(
                            $this->sections[static::METHODS_SECTION],
                            function($carry, $function) {

                                $parameterString = '';
                                $functionComment = $function->getComment();

                                foreach ($function->getParameters() as $parameter) {

                                    list($namespace, $type) = $this->extractType($parameter->getType());

                                    if ($namespace) {
                                        $this->use($namespace);
                                    }

                                    $parameterString .= ($type? $type . ' ' : '')
                                        . '$' . $parameter->getName()
                                        . ($parameter->getValue()? ' = ' . $this->printValue($parameter->getValue(), $parameter->getType()) : '')
                                        . ', ';

                                    $functionComment .= $this->codingStyle->getNewLine() . '@param ' . $type ;
                                }

                                $returnType = $function->getType();
                                if ($returnType) {
                                    list($namespace, $returnType) = $this->extractType($returnType);
                                    if ($namespace) {
                                        $this->use($namespace);
                                    }

                                    $functionComment .= $this->codingStyle->getNewLine()
                                        . '@return '
                                        . ($returnType? : 'mixed');
                                }

                                $comment = $this->generateDocComment(
                                    $functionComment,
                                    $this->codingStyle->getIndentation(),
                                    $this->codingStyle->getNewLine()
                                );

                                $carry .= rtrim(
                                    $this->codingStyle->getNewLine()
                                    . $comment
                                    . $this->codingStyle->getIndentation()
                                    . ($function->isAbstract() ? 'abstract ' : '')
                                    . ($function->isFinal() ? 'final ' : '')
                                    . ($function->getVisibility() ? $function->getVisibility()  . ' ' : '')
                                    . ($function->isStatic() ? 'static ' : '')
                                    . 'function '
                                    . $function->getName()
                                    . '('
                                    . rtrim($parameterString, ', ')
                                    . ')'
                                    . ($returnType? ': ' . $returnType : '')
                                    . (
                                    ($this instanceof InterfaceCreator || $function->isAbstract()) ? ';' :
                                        ($this->codingStyle->isMethodBracesInNewLine()? $this->codingStyle->getNewLine() : '')
                                        . $this->codingStyle->getIndentation()
                                        . '{'
                                        . $this->codingStyle->getNewLine()
                                        . $this->codingStyle->getNewLine()
                                        . $this->codingStyle->getIndentation()
                                        . '}'
                                    )
                                ) . $this->getCodingStyle()->getNewLine();

                                return $carry;
                            },
                            ''
                        )
                    );

            }

            $classContent = rtrim($classContent) . $this->codingStyle->getNewLine()
                . '}'
                . $this->codingStyle->getNewLine();
        }

        $phpFileContent = '<?php'
            . $this->codingStyle->getNewLine()
            . $this->codingStyle->getNewLine();

        if ($this->sections[static::NAMESPACE_SECTION]) {
            $phpFileContent .= $this->sections[static::NAMESPACE_SECTION]
                . $this->codingStyle->getNewLine()
                . $this->codingStyle->getNewLine();
        }

        if ($this->sections[static::USE_SECTION]) {
            $phpFileContent .= array_reduce($this->sections[static::USE_SECTION], function($carry, $section) {
                    $carry .= $section . $this->codingStyle->getNewLine();
                    return $carry;
                }, '')
                . $this->codingStyle->getNewLine();
        }

        $phpFileContent .= $classContent;

        if (substr($phpFileContent, -2) !== "\n\n" && $this->codingStyle->useUnixLineFeedEnding()) {
            $phpFileContent .= $this->codingStyle->getNewLine();
        }

        if ($this->codingStyle->usePhpClosingTag()) {
            $phpFileContent .= "\n?>";
        }

        return $phpFileContent;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function saveToFile(string $fileName)
    {
        return file_put_contents(
            $fileName,
            $this->toString(),
            'r+'
        );
    }
}