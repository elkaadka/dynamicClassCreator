<?php

namespace Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\CodingStyle\Psr2;
use Kanel\Enuma\Component\Constant;
use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Helper\ClassNameExtractor;
use Kanel\Enuma\Printer\ClassEndPrinter;
use Kanel\Enuma\Printer\ClassPrinter;
use Kanel\Enuma\Printer\ConstPrinter;
use Kanel\Enuma\Printer\FunctionPrinter;
use Kanel\Enuma\Printer\NamespacePrinter;
use Kanel\Enuma\Printer\PropertyPrinter;
use Kanel\Enuma\Printer\StartTagPrinter;
use Kanel\Enuma\Printer\TraitPrinter;
use Kanel\Enuma\Printer\UsePrinter;

class ClassCreator
{
    use ClassNameExtractor;

    protected $sections;
    protected $codingStyle;

    public function __construct(CodingStyle $codingStyle = null)
    {
        $this->codingStyle = $codingStyle ?? new Psr2();
        $this->sections = new Sections();

    }

    public function getCodingStyle(): CodingStyle
    {
        return $this->codingStyle;
    }

    public function namespace(string $namespace)
    {
    	$this->sections->addSection(Sections::NAMESPACE_SECTION, $namespace);

        return $this;
    }

    public function use(string...$classes)
    {
        foreach ($classes as $class) {
			$this->sections->addSection(Sections::USE_SECTION, $class);
        }

        return $this;
    }

    public function abstract()
    {
		$this->sections->addSection(Sections::CLASS_FINAL_ABSTRACT_SECTION, 'abstract');

        return $this;
    }

    public function final()
    {
		$this->sections->addSection(Sections::CLASS_FINAL_ABSTRACT_SECTION, 'final');

        return $this;
    }

    public function class(string $name)
    {
		$this->sections->addSection(Sections::CLASS_TYPE_SECTION, 'class');
		$this->sections->addSection(Sections::CLASS_NAME, $name);

        return $this;
    }

    public function extends(string $className)
    {
        list($namespace, $class) = self::extractType($className);

        if ($namespace) {
            $this->use($namespace);
        }

		$this->sections->addSection(Sections::CLASS_EXTENDS_SECTION, $class);

        return $this;
    }

    public function implements(string...$interfaces)
    {
        foreach ($interfaces as $interface) {

        	list($namespace, $class) = self::extractType($interface);

            if ($namespace) {
                $this->use($namespace);
            }

			$this->sections->addSection(Sections::CLASS_IMPLEMENTED_CLASSES_SECTION, $class);
        }

        return $this;
    }

    public function comment(string $comment)
    {
		$this->sections->addSection(Sections::CLASS_COMMENT_SECTION, $comment);

        return $this;
    }

    public function useTraits(string...$traits)
    {
        foreach ($traits as $trait) {
            list($namespace, $trait) = self::extractType($trait);

            if ($namespace) {
                $this->use($namespace);
            }

			$this->sections->addSection(Sections::TRAIT_SECTION, $trait);
        }

        return $this;
    }

    public function addConst(Constant $const)
    {
		$this->sections->addSection(Sections::CONST_SECTION, $const);

        return $this;
    }

    public function addProperty(Property $property)
    {
		$this->sections->addSection(Sections::PROPERTIES_SECTION, $property);

        return $this;
    }

    public function addFunction(Method $function)
    {
		$extraComment = '';
    	foreach ($function->getParameters() as $parameter) {
			list($namespace, $type) = self::extractType($parameter->getType());

			if ($namespace) {
				$this->use($namespace);
			}

			$extraComment .= $this->codingStyle->getNewLine()
				. '@param ' . ($type? : 'mixed')
				. ' $'
				. $parameter->getName();

			$parameter->setType($type);
		}

		$returnType = $function->getType();
		if ($returnType) {
			list($namespace, $returnType) = self::extractType($returnType);
			if ($namespace) {
				$this->use($namespace);
			}
			$function->setType($returnType);
		}

		$extraComment .= $this->codingStyle->getNewLine()
			. '@return '
			. ($function->getType() ? : 'mixed');


		$function->setComment($function->getComment() . $extraComment);
		$this->sections->addSection(Sections::METHODS_SECTION, $function);

        return $this;
    }

    public function toString() : string
    {
        $content = StartTagPrinter::print($this->sections, $this->codingStyle);
		$content .= NamespacePrinter::print($this->sections, $this->codingStyle);
		$content .= UsePrinter::print($this->sections, $this->codingStyle);

		$class =  ClassPrinter::print($this->sections, $this->codingStyle);

		if($class) {
			$class .= TraitPrinter::print($this->sections, $this->codingStyle);
			$class .= ConstPrinter::print($this->sections, $this->codingStyle);
			$class .= PropertyPrinter::print($this->sections, $this->codingStyle);
			$class .= FunctionPrinter::print($this->sections, $this->codingStyle);
			$class = rtrim($class) . ClassEndPrinter::print($this->sections, $this->codingStyle);
		}

		$content .= $class;

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