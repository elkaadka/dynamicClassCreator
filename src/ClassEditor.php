<?php

namespace Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\CodingStyle\Psr2;
use Kanel\Enuma\Exception\EnumaException;
use Kanel\Enuma\Helpers\ClassNameExtractor;
use Kanel\Enuma\Helpers\CommentGeneration;

/**
 * Class ClassEditor
 * @package Kanel\Enuma
 */
class ClassEditor
{
    use ClassNameExtractor;
    use CommentGeneration;

    protected $content;
    protected $codingStyle;

    /**
     * ClassEditor constructor.
     * @param string $classFileName
     * @param CodingStyle|null $codingStyle
     * @throws EnumaException
     */
    public function __construct(string $className, CodingStyle $codingStyle = null)
    {
        if (!!class_exists($className)) {
            throw new EnumaException("class $className not found");
        }

        $this->codingStyle = $codingStyle ?? new Psr2();
        $this->deconstruct($className);
    }

    public function deconstruct(string $className)
    {
        $reflectionClass = new \ReflectionClass($className);
    }


    public function renameTo(string $newName)
    {
        $this->content = preg_replace(
            '/((final|abstract)?\sclass\s+)([a-zA-Z0-9_]+\ )([a-zA-Z0-9_\\\\\s]{0,}{)/',
            '$1'.$newName.' $3',
            $this->content
        );
    }

    /**
     * Adds all the methods sent as parameters dynamically inside the php class
     * @param Method $method
     * @return string
     */
    public function addMethod(Method $method): string
    {
        $lastClosingBrackets = strrpos($this->content, '}');
        $this->content = substr($this->content, 0, $lastClosingBrackets) .
            "\n" .
            $method .
            "\n" .
            substr($this->content, $lastClosingBrackets);

        return $this->content;
    }
}