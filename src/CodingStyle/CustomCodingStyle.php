<?php

namespace Kanel\Dynamic\CodingStyle;

/**
 * Class CustomCodingStyle
 * Defines some custom coding style rules to generate the classes/methods/...
 * @package Kanel\Dynamic\CodingStyle
 */
class CustomCodingStyle extends CodingStyle
{
    /**
     * Tells if the file needs to have a BOM
     * Default value is false. You may change it here
     * @param bool $useBom
     * @return CustomCodingStyle
     */
    public function setUseBom(bool $useBom): CustomCodingStyle
    {
        $this->useBom = $useBom;

        return $this;
    }

    /**
     * Sets the encoding
     * Default is UTF-8
     * @param string $encoding
     * @return CustomCodingStyle
     */
    public function setEncoding(string $encoding): CustomCodingStyle
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Defines if the file needs to have a closin tag ?>
     * Default value is false
     * @param bool $usePhpClosingTag
     * @return CustomCodingStyle
     */
    public function setUsePhpClosingTag(bool $usePhpClosingTag): CustomCodingStyle
    {
        $this->usePhpClosingTag = $usePhpClosingTag;

        return $this;
    }

    /**
     * Defines the identation to use
     * Can either be spaces or tabs
     * Default is 4 spaces
     * @param string $indentation the indentation to uses
     * @param int $count the number of repetition for the indetation (4 spaces, 3 tabs, ...)
     * @return CustomCodingStyle
     */
    public function setIndentation(string $indentation, int $count): CustomCodingStyle
    {
        $this->indentation = $indentation;

        return $this;
    }

    /**
     * Tells if the opening brace { after the class name must be in a new line
     * True means yes, false means same line
     * Default value is true
     * @param bool $classBracesInNewLine
     * @return CustomCodingStyle
     */
    public function setClassBracesInNewLine(bool $classBracesInNewLine): CustomCodingStyle
    {
        $this->classBracesInNewLine = $classBracesInNewLine;

        return $this;
    }

    /**
     * Tells if the opening brace { after the method name must be in a new line
     * True means yes, false means same line
     * Default value is true
     * @param bool $methodBracesInNewLine
     * @return CustomCodingStyle
     */
    public function setMethodBracesInNewLine(bool $methodBracesInNewLine): CustomCodingStyle
    {
        $this->methodBracesInNewLine = $methodBracesInNewLine;

        return $this;
    }

    /**
     * Tells if the file needs to end with a linux Feed line \n
     * Default value is yes
     * @param bool $unixLineFeedEnding
     * @return CustomCodingStyle
     */
    public function setUnixLineFeedEnding(bool $unixLineFeedEnding): CustomCodingStyle
    {
        $this->unixLineFeedEnding = $unixLineFeedEnding;

        return $this;
    }

    /**
     * set to true if you want to use windows new lines \r\n
     * Set to false to use Unix new line \n
     * @param bool $useWindowsNewLine
     * @return CustomCodingStyle
     */
    public function useWindowsNewLine(bool $useWindowsNewLine): CustomCodingStyle
    {
        $this->newLine = $useWindowsNewLine? "\r\n" : "\n";

        return $this;
    }

}