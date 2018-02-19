<?php

namespace spec\Kanel\Enuma\Component;

use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Hint\VisibilityHint;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropertySpec extends ObjectBehavior
{
	function it_needs_at_least_a_name_and_a_visibility()
	{
		$this->beConstructedWith('foo', VisibilityHint::PUBLIC);
	}

	function it_maybe_constructed_with_default_value()
	{
		$this->beConstructedWith('foo', VisibilityHint::PUBLIC, 'false');
	}

	function it_maybe_constructed_with_default_value_and_define_if_static()
	{
		$this->beConstructedWith('foo', VisibilityHint::PUBLIC, 'false', true);
	}

	function it_maybe_be_possible_to_use_setters()
	{
		$this->beConstructedWith('foo', VisibilityHint::PUBLIC, 'false', true);

		$this->getName()->shouldBe('foo');
		$this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
		$this->getValue()->shouldBe('false');
		$this->isStatic()->shouldBe(true);

		$this->setName('fooTwo')->shouldBeAnInstanceOf(Property::class);
		$this->setVisibility(VisibilityHint::PROTECTED)->shouldBeAnInstanceOf(Property::class);
		$this->setValue('null')->shouldBeAnInstanceOf(Property::class);
		$this->setIsStatic(false)->shouldBeAnInstanceOf(Property::class);

		$this->getName()->shouldBe('fooTwo');
		$this->getVisibility()->shouldBe(VisibilityHint::PROTECTED);
		$this->getValue()->shouldBe('null');
		$this->isStatic()->shouldBe(false);
	}
}
