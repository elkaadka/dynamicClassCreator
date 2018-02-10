<?php

namespace Kanel\Dynamic;

use Kanel\ClassEditor\Components\Property;
use Kanel\Dynamic\CodingStyle\CodingStyle;
use Kanel\Dynamic\Component\ClassNameSpace;

class ClassWriter
{
    protected $content;
    protected $codingStyle;

    public function __construct(CodingStyle $codingStyle)
    {
        $this->codingStyle = $codingStyle;
        $this->content = '';
    }

    public function openPhpTag()
    {
        $this->content .= "<?php"
            . $this->codingStyle->getNewLine()
            . $this->codingStyle->getNewLine()
        ;

        return $this->content;
    }

    public function writeNamespace(ClassNameSpace $namespace)
    {
        $this->content .=  $namespace
            . $this->codingStyle->getNewLine()
            . $this->codingStyle->getNewLine()
        ;

        return $this->content;
    }

    public function useNamespaces(array $namespaces)
    {
        $this->content .= array_reduce($namespaces, function($carry, $namespace) {
            $carry .= "use $namespace" . $this->codingStyle->getNewLine();
            return $carry;
        }) ;

        return $this->content;
    }

    public function writeClass(string $className)
    {
        $this->content .= "class $className";

        return $this->content;
    }

    public function writeProperty(Property $property)
    {

    }

    public function openClassBraces()
    {
        $this->content .= ($this->codingStyle->isClassBracesInNewLine()? $this->codingStyle->getNewLine() : "") .
            "{" .
            $this->codingStyle->getNewLine()
        ;

        return $this->content;
    }

    public function useTraits(array $traits)
    {
        $this->content .= array_reduce($traits, function($carry, $trait) {
            $carry .= "use $trait" . $this->codingStyle->getNewLine();
            return $carry;
        });
    }

    public function

    public function closeClassBraces()
    {
        $this->content .=  "\n}";

        return $this->content;
    }

    public function closePhpTag()
    {
        if ($this->codingStyle->usePhpClosingTag()) {
            $this->content .= "\n?>";
        }

        if ($this->codingStyle->useUnixLineFeedEnding()) {
            $this->content .= "\n";
        }

        return $this->content;
    }
}