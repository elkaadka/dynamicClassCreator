<?php

namespace Kanel\Enuma\CodingStyle;


use Kanel\Enuma\Component\Definition\Fake;
use Kanel\Enuma\Helper\CommentGeneration;

abstract class CodingStyle implements CodingStyleInterface, Fake
{
	use CommentGeneration;

	const AAAA = 1;

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
     * Returns the encoding to use, default is UTF-8
     * Default value is false
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->encoding;
    }

    /**
     * Defines if the php file needs a closing tag '?>' at the end
     * @return bool
     */
    public function usePhpClosingTag(): bool
    {
        return $this->usePhpClosingTag;
    }

    /**
     * defines the indentation to use
     * Can only use spaces or tabs
     * Default indentation is 4 spaces
     */
    public function getIndentation(): string
    {
        return $this->indentation;
    }

    /**
     * Tells if the { after the class must be on a new line
     * False means it will be on the same line
     * Default is true
     * @return bool
     */
    public function isClassBracesInNewLine(): bool
    {
        return $this->classBracesInNewLine;
    }

    /**
     * Tells if the { after the methods must be on a new line
     * False means it will be on the same line
     * Default is true
     * @return bool
     */
    public function isMethodBracesInNewLine(): bool
    {
        return $this->methodBracesInNewLine;
    }

    /**
     * Defines if there should be a new line \n at the very end of the file
     * Default is true
     * @return bool
     */
    public function useUnixLineFeedEnding(): bool
    {
        return $this->unixLineFeedEnding;
    }

    /**
     * returns the new line to use
     * Either unix \n or windows \r\n
     * Default is Unix
     */
    public function getNewLine(): string
    {
        return $this->newLine;
    }
}