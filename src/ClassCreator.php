<?php

namespace Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\CodingStyle\Psr2;
use Kanel\Enuma\Component\ConstDefinition;
use Kanel\Enuma\Component\FunctionDefinition;
use Kanel\Enuma\Component\PropertyDefinition;
use Kanel\Enuma\Helpers\ClassNameExtractor;
use Kanel\Enuma\Helpers\CommentGeneration;
use Kanel\Enuma\Helpers\ValuePrinter;

class ClassCreator
{
    use ClassNameExtractor;
    use CommentGeneration;
    use ValuePrinter;

    const KEYWORD = 'class';

    const PHP_OPEN_TAG_SECTION = 0;
    const NAMESPACE_SECTION = 1;
    const USE_SECTION = 2;
    const CLASS_COMMENT_SECTION = 3;
    const CLASS_TYPE_SECTION = 4;
    const CLASS_DECLARATION_SECTION = 5;
    const CLASS_EXTENDS_SECTION = 6;
    const CLASS_IMPLEMENTS_SECTION = 7;
    const TRAIT_SECTION = 8;
    const CONST_SECTION = 9;
    const PROPERTIES_SECTION = 10;
    const METHODS_SECTION = 11;
    const CLASS_END_SECTION = 12;
    const PHP_CLOSE_TAG_SECTION0 = 13;

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

        $this->sections[self::PHP_OPEN_TAG_SECTION] = '<?php'
            . $this->codingStyle->getNewLine()
            . $this->codingStyle->getNewLine()
        ;

        $this->sections[self::PHP_CLOSE_TAG_SECTION0] = '';

        if ($this->codingStyle->usePhpClosingTag()) {
            $this->sections[self::PHP_CLOSE_TAG_SECTION0] = "\n?>";
        }

        if ($this->codingStyle->useUnixLineFeedEnding()) {
            $this->sections[self::PHP_CLOSE_TAG_SECTION0] = "\n";
        }
    }

    public function name(string $name)
    {
        $this->sections[self::CLASS_DECLARATION_SECTION] = self::KEYWORD . ' ' . $name .
            ($this->codingStyle->isClassBracesInNewLine()? $this->codingStyle->getNewLine() : "") .
            "{" .
            $this->codingStyle->getNewLine();
    }

    public function makeAbstract()
    {
        $this->sections[self::CLASS_TYPE_SECTION] = 'abstract ';
    }

    public function makeFinal()
    {
        $this->sections[self::CLASS_TYPE_SECTION] = 'final ';
    }

    public function extends(string $className)
    {
        list($namespace, $class) = $this->extractType($className);

        if ($namespace) {
            $this->use($namespace);
        }

        $this->sections[self::CLASS_EXTENDS_SECTION] = ' extends' . $class;
    }

    public function implements(string $className)
    {
        $this->sections[self::CLASS_IMPLEMENTS_SECTION] = $this->sections[self::CLASS_IMPLEMENTS_SECTION]? ', ' : ' implements ';

        list($namespace, $class) = $this->extractType($className);

        if ($namespace) {
            $this->use($namespace);
        }

        $this->sections[self::CLASS_EXTENDS_SECTION] .=  $class;
    }

    public function comment(string $comment)
    {
        $this->sections[self::CLASS_COMMENT_SECTION] = $this->generateDocComment($comment, null, $this->codingStyle->getNewLine()) .
            $this->codingStyle->getNewLine()
        ;
    }

    public function namespace(string $namespace)
    {
        $this->sections[self::NAMESPACE_SECTION] = 'namespace ' . $namespace . $this->codingStyle->getNewLine();
    }

    public function use(string $class)
    {
        $this->sections[self::USE_SECTION] = $this->sections[self::USE_SECTION] ?? '';
        $this->sections[self::USE_SECTION] .= 'use ' . $class . $this->codingStyle->getNewLine();
    }

    public function trait(string $trait)
    {
        $this->sections[self::TRAIT_SECTION] = $this->sections[self::TRAIT_SECTION] ?? '';

        list($namespace, $trait) = $this->extractType($trait);

        if ($namespace) {
            $this->use($namespace);
        }

        if ($trait) {
            $this->sections[self::TRAIT_SECTION] .= 'use' . $trait . $this->codingStyle->getNewLine();
        }
    }

    public function addProperty(PropertyDefinition $property)
    {
        $this->sections[self::PROPERTIES_SECTION] = $this->sections[self::PROPERTIES_SECTION] ?? '';

        $this->sections[self::PROPERTIES_SECTION] .= $this->generateDocComment(
            $property->getComment(),
            $this->codingStyle->getIndentation(),
            $this->codingStyle->getNewLine()
        ) . $this->codingStyle->getIndentation()
            . ($property->getVisibility()? $property->getVisibility() . ' ' : '')
            . ($property->isStatic() ? 'static ' : '')
            . ' $' . $property->getName()
            . ($property->getDefaultValue() ? ' = ' . $this->printValue($property->getDefaultValue()) : '')
            . ';'
            . $this->codingStyle->getNewLine()
        ;
    }

    public function addConst(ConstDefinition $const)
    {
        $this->sections[self::CONST_SECTION] = $this->sections[self::CONST_SECTION] ?? '';

        $this->sections[self::CONST_SECTION] .= $this->generateDocComment(
                $const->getComment(),
                $this->codingStyle->getIndentation(),
                $this->codingStyle->getNewLine()
            ) . $this->codingStyle->getIndentation()
            . ($const->getVisibility()? $const->getVisibility() . ' ' : '')
            . 'const ' . $const->getName()
            . ' = ' . $this->printValue($const->getValue())
            . ';'
            . $this->codingStyle->getNewLine()
        ;
    }

    public function addFunction(FunctionDefinition $function)
    {
        $this->sections[self::METHODS_SECTION] = $this->sections[self::METHODS_SECTION] ?
            $this->sections[self::METHODS_SECTION] . $this->codingStyle->getNewLine() . $this->codingStyle->getNewLine() : '';

        $comment = $function->getComment();
        $stringParamaters = '';

        foreach ($function->getParameters() as $parameter) {

            list($namespace, $type) = $this->extractType($parameter->getType());

            if ($namespace) {
                $this->use($namespace);
            }

            $stringParamaters .= ($type? $type . ' ' : '')
                . '$' . $parameter->getName()
                . ($parameter->getDefaultValue()? ' = ' . $this->printValue($parameter->getDefaultValue()) : '')
                . ', ';


            $comment .= $this->codingStyle->getNewLine() . '@param ' . $type ;
        }

        list($namespace, $type) = $this->extractType($function->getReturnType());

        if ($namespace) {
            $this->use($namespace);
        }

        if ($type) {
           $stringReturnType = '? ' . $type;
           $comment .= $this->codingStyle->getNewLine() . '@return ' . $type ;
        }

        $comment .= $this->codingStyle->getNewLine() . '@param ' . $type ;

        $this->sections[self::METHODS_SECTION] .= $this->generateDocComment(
                $comment,
                $this->codingStyle->getIndentation(),
                $this->codingStyle->getNewLine()
            ) . $this->codingStyle->getIndentation()
            . ($function->isAbstract() ? 'abstract ' : '')
            . ($function->isFinal() ? 'final ' : '')
            . ($function->getVisibility() ? $function->getVisibility()  . ' ' : '')
            . ($function->isStatic() ? 'static ' : '')
            . 'function '
            . $function->getName()
            . '('
            . rtrim($stringParamaters, ', ')
            . ')'
            . $stringReturnType
            . (
                !$function->hasBody() ? ';' :
                    ($this->codingStyle->isMethodBracesInNewLine()? $this->codingStyle->getNewLine() : '')
                    . '{'
                    . $this->codingStyle->getNewLine()
                    . $this->codingStyle->getNewLine()
                    . '}'
            );
        ;
    }

    public function getAsString() : string
    {
        return array_reduce($this->sections, function($carry, $section) {
            $carry .= $section;
            return $carry;
        }, '');
    }

    public function saveToFile(string $fileName)
    {
        return file_put_contents(
            $fileName,
            array_reduce($this->sections, function($carry, $section) {
                $carry .= $section;
                return $carry;
            },
            ''
            )
        );
    }
}