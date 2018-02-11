<?php

namespace spec\Kanel\Enuma\CodingStyle;

use Kanel\Enuma\CodingStyle\Psr2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Psr2Spec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Psr2::class);
    }

    protected $encoding = 'UTF-8';
    protected $usePhpClosingTag = false;
    protected $indentation = '    ';
    protected $classBracesInNewLine = true;
    protected $methodBracesInNewLine = true;
    protected $unixLineFeedEnding = true;
    protected $lowerCaseKeyWords = true;
    protected $newLine = "\n";

    public function it_should_use_utf8_encoding()
    {
        $this->getEncoding()->shouldReturn('UTF-8');
    }

    public function it_should_not_use_php_closing_tags()
    {
        $this->usePhpClosingTag()->shouldBe(false);
    }

    public function it_should_use_four_space_indentation()
    {
        $this->getIndentation()->shouldBe('    ');
    }

    public function it_should_have_class_braces_in_new_line()
    {
        $this->isClassBracesInNewLine()->shouldBe(true);
    }

    public function it_should_have_methods_braces_in_new_line()
    {
        $this->isMethodBracesInNewLine()->shouldBe(true);
    }

    public function it_should_have_a_line_feed()
    {
        $this->useUnixLineFeedEnding()->shouldBe(true);
    }

    public function it_should_have_unix_new_lines()
    {
        $this->getNewLine()->shouldBe("\n");
    }
}
