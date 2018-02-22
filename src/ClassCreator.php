<?php

namespace Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\CodingStyle\Psr2;
use Kanel\Enuma\Component\Class_;
use Kanel\Enuma\Component\Comment_;
use Kanel\Enuma\Component\Constant;
use Kanel\Enuma\Component\Extend_;
use Kanel\Enuma\Component\Interface_;
use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Namespace_;
use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Component\Trait_;
use Kanel\Enuma\Component\Use_;
use Kanel\Enuma\Helper\ClassNameExtractor;
use Kanel\Enuma\Tokenizer\StartTagTokenizer;

class ClassCreator
{
    use ClassNameExtractor;

	protected $codingStyle;
	protected $class;

    public function __construct(CodingStyle $codingStyle = null)
    {
        $this->codingStyle = $codingStyle ?? new Psr2();
		$this->class = new Class_('NoName');
    }

    public function getCodingStyle(): CodingStyle
    {
        return $this->codingStyle;
    }

    public function namespace(string $namespace)
    {
        $this->class->setNamespace(new Namespace_($namespace));

        return $this;
    }

    public function use(string...$classes)
    {
        foreach ($classes as $class) {
            $this->class->setUse(new Use_($class));
        }

        return $this;
    }

    public function abstract()
    {
		$this->class->setIsAbstract(true);

        return $this;
    }

    public function final()
    {
		$this->class->setIsFinal(true);

        return $this;
    }

    public function class(string $name)
    {
		$this->class->setName($name);
		return $this;
    }

    public function extends(string $className)
    {
        list($namespace, $class) = self::extractType($className);

        if ($namespace) {
            $this->use($namespace);
        }

        $this->class->setExtend(new Extend_($class));

        return $this;
    }

    public function implements(string...$interfaces)
    {
        foreach ($interfaces as $interface) {

            list($namespace, $class) = self::extractType($interface);

            if ($namespace) {
                $this->use($namespace);
            }

			$this->class->setImplement(new Interface_($class));
        }

        return $this;
    }

    public function comment(string $comment)
    {
		$this->class->setComment(new Comment_($comment));

        return $this;
    }

    public function useTrait(string...$traits)
    {
        foreach ($traits as $trait) {
            list($namespace, $trait) = self::extractType($trait);

            if ($namespace) {
                $this->use($namespace);
            }

            $this->class->setTrait(new Trait_($trait));
        }

        return $this;
    }

    public function addConst(Constant...$consts)
    {
		foreach ($consts as $const) {
			$this->class->setConst($const);
		}

        return $this;
    }

    public function addProperty(Property...$properties)
    {
		foreach ($properties as $property) {
			$this->class->setProperty($property);
		}

        return $this;
    }

    public function addMethod(Method $method)
    {
        $extraComment = '';
        foreach ($method->getParameters() as $parameter) {
            list($namespace, $type) = self::extractType($parameter->getType());

            if ($namespace) {
                $this->use($namespace);
            }

            $parameter->setType($type);

            if ($method->hasExtraComment()) {
                $extraComment .= $this->codingStyle->getNewLine(). '@param ' . ($type? : 'mixed')
                    . ' $'
                    . $parameter->getName();
            }
        }

        $returnType = $method->getType();
        if ($returnType) {
            list($namespace, $returnType) = self::extractType($returnType);
            if ($namespace) {
                $this->use($namespace);
            }
            $method->setType($returnType);
        }

        if ($method->hasExtraComment()) {
            $extraComment =  rtrim($extraComment) . $this->codingStyle->getNewLine() . '@return '
                . ($method->getType() ? : 'mixed');
        }

        $method->setComment(new Comment_(rtrim($method->getComment()) . rtrim($extraComment)));
        $this->class->setMethod($method);

        return $this;
    }

    public function toString() : string
    {
    	print_r($this->class);
    	return '';
    	$tokenizer = new Tokenizer($this->class, $this->codingStyle);
		$tokenizer->tokenize();

        $content = StartTagTokenizer::print($this->sections, $this->codingStyle)
            . NamespacePrinter::print($this->sections, $this->codingStyle)
            . UsePrinter::print($this->sections, $this->codingStyle);

        //If a class was declared
        if($this->sections->getSection(Sections::CLASS_NAME)) {
            $content .=  rtrim(
                ClassPrinter::print($this->sections, $this->codingStyle)
                . TraitPrinter::print($this->sections, $this->codingStyle)
                . ConstPrinter::print($this->sections, $this->codingStyle)
                . PropertyPrinter::print($this->sections, $this->codingStyle)
                . FunctionPrinter::print($this->sections, $this->codingStyle)
            ) . ClassEndPrinter::print($this->sections, $this->codingStyle);
        }

        print_r(Tokenizer::tokenGetAll());

        if (substr($content, -2) !== "\n\n" && $this->codingStyle->useUnixLineFeedEnding()) {
            $content .= $this->codingStyle->getNewLine();
        }

        if ($this->codingStyle->usePhpClosingTag()) {
            $content .= "\n?>";
        }

        return $content;
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