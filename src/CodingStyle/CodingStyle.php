<?php

namespace Kanel\Dynamic\CodingStyle;

abstract class CodingStyle implements CodingStyleInterface
{
    protected $useBom = false;
    protected $encoding = 'UTF-8';
    protected $usePhpClosingTag = false;
    protected $indentation = '    ';
    protected $classBracesInNewLine = true;
    protected $methodBracesInNewLine = true;
    protected $unixLineFeedEnding = true;
    protected $lowerCaseKeyWords = true;
    protected $newLine = "\n";

    public function __construct()
    {

    }

    /**
     * Specifies if php files must use a BOM
     * defaut value is false
     * @return bool
     */
    public function useBom(): bool
    {
        return $this->useBom;
    }

    /**
     * Returns the encoding to use, default is UTF-8
     * Default value is false
     * @return string
     */
    public function getEncoding(): string
    {
        // TODO: Implement getEncoding() method.
    }

    /**
     * Defines if the php file needs a closing tag '?>' at the end
     * @return bool
     */
    public function usePhpClosingTag(): bool
    {
        // TODO: Implement useClosingTag() method.
    }

    /**
     * defines the indentation to use
     * Can only use spaces or tabs
     * Default indentation is 4 spaces
     */
    public function getIndentation()
    {
        // TODO: Implement getIndentation() method.
    }

    /**
     * Tells if the { after the class must be on a new line
     * False means it will be on the same line
     * Default is true
     * @return bool
     */
    public function isClassBracesInNewLine(): bool
    {
        // TODO: Implement isClassBracesInNewLine() method.
    }

    /**
     * Tells if the { after the methods must be on a new line
     * False means it will be on the same line
     * Default is true
     * @return bool
     */
    public function isMethodBracesInNewLine(): bool
    {
        // TODO: Implement isMethodBracesInNewLine() method.
    }

    /**
     * Defines if there should be a new line \n at the very end of the file
     * Default is true
     * @return bool
     */
    public function useUnixLineFeedEnding(): bool
    {
        // TODO: Implement useUnixLineFeed() method.
    }

    /**
     * returns the new line to use
     * Either unix \n or windows \r\n
     * Default is Unix
     */
    public function getNewLine(): string
    {
        // TODO: Implement getNewLine() method.
    }
}