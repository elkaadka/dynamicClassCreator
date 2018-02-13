<?php

namespace spec\Kanel\Enuma\Component;

use Kanel\Enuma\Exception\EnumaException;
use Kanel\Enuma\Hint\VisibilityHint;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConstantSpec extends ObjectBehavior
{
	function it_should_be_constructed_with_name_and_value()
	{
		$this->beConstructedWith('CONST_NAME', 'Hello');
		$this->getName()->shouldBe('CONST_NAME');
		$this->getValue()->shouldBe('Hello');
	}

	function it_should_also_be_constructed_with_visibility()
	{
		$this->beConstructedWith('CONST_NAME', 'Hello', VisibilityHint::PRIVATE);
		$this->getName()->shouldBe('CONST_NAME');
		$this->getValue()->shouldBe('Hello');
		$this->getVisibility()->shouldBe(VisibilityHint::PRIVATE);
	}

	function it_should_throw_an_exception_if_unknown_visibility()
	{
		$this->beConstructedWith('CONST_NAME', 'Hello', 'World');
		$this->shouldThrow(EnumaException::class)->duringInstantiation();
	}
}
