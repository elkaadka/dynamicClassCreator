<?php

namespace spec\Kanel\Enuma\CodingStyle;

use Kanel\Enuma\CodingStyle\CustomCodingStyle;
use Kanel\Enuma\Exception\EnumaException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CustomCodingStyleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CustomCodingStyle::class);
    }

    public function it_should_to_utf8_encoding()
    {
        $this->getEncoding()->shouldReturn('UTF-8');
    }

    public function it_should_be_able_to_change_encoding()
    {
        $this->setEncoding('UTF-8')->shouldBeAnInstanceOf(CustomCodingStyle::class);
        $this->getEncoding()->shouldReturn('UTF-8');
    }

    public function it_should_throw_an_exception_if_encoding_is_unkown()
    {
        $this->shouldThrow(EnumaException::class)->during('setEncoding', ['encoding_that_does_not_exist']);
    }

    public function it_should_not_use_php_closing_tags_by_default()
    {
        $this->usePhpClosingTag()->shouldBe(false);
    }

    public function it_should_be_possible_to_use_php_closing_tags_by_default()
    {
        $this->setUsePhpClosingTag(true)->shouldBeAnInstanceOf(CustomCodingStyle::class);
        $this->usePhpClosingTag()->shouldBe(true);
    }

    public function it_should_use_four_space_indentation_by_default()
    {
        $this->getIndentation()->shouldBe('    ');
    }

    public function it_should_be_possible_to_choose_indentation()
    {
        $this->setIndentation(CustomCodingStyle::INDENTATION_TAB, 2)->shouldBeAnInstanceOf(CustomCodingStyle::class);
        $this->getIndentation()->shouldBe("\t\t");
    }

    public function it_should_have_class_braces_in_new_line_by_default()
    {
        $this->isClassBracesInNewLine()->shouldBe(true);
    }

    public function it_should_be_possible_to_set_class_braces_in_same_line()
    {
        $this->setClassBracesInNewLine(false)->shouldBeAnInstanceOf(CustomCodingStyle::class);
        $this->isClassBracesInNewLine()->shouldBe(false);
    }

    public function it_should_have_methods_braces_in_new_line_by_default()
    {
        $this->isMethodBracesInNewLine()->shouldBe(true);
    }

    public function it_should__be_possible_to_have_methods_braces_in_same_line()
    {
        $this->setMethodBracesInNewLine(false)->shouldBeAnInstanceOf(CustomCodingStyle::class);
        $this->isMethodBracesInNewLine()->shouldBe(false);
    }

    public function it_should_have_unix_new_lines_by_default()
    {
        $this->getNewLine()->shouldBe("\n");
    }

    public function it_should_be_possible_to_define_windows_new_line()
    {
        $this->useWindowsNewLine(true)->shouldBeAnInstanceOf(CustomCodingStyle::class);
        $this->getNewLine()->shouldBe("\r\n");
    }

    public function it_should_have_a_line_feed_by_default()
    {
        $this->useUnixLineFeedEnding()->shouldBe(true);
    }

    public function it_should_have_be_possible_to_not_have_a_line_feed()
    {
        $this->setUnixLineFeedEnding(false)->shouldBeAnInstanceOf(CustomCodingStyle::class);
        $this->useUnixLineFeedEnding()->shouldBe(false);
    }
}
