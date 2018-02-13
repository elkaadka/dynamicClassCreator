<?php

namespace spec\Kanel\Enuma\Component;

use Kanel\Enuma\Component\Parameter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParameterSpec extends ObjectBehavior
{
	function it_needs_at_least_a_name()
	{
		$this->beConstructedWith('foo');
	}

	function it_can_be_defined_with_a_type_and_a_default_value()
	{
		$this->beConstructedWith('foo', 'bool', 'true');
	}

	function it_should_be_possible_to_use_setters()
	{
		$this->beConstructedWith('foo');

		$this->setName('fooTwo')->shouldBeAnInstanceOf(Parameter::class);
		$this->setType('string')->shouldBeAnInstanceOf(Parameter::class);
		$this->setValue('null')->shouldBeAnInstanceOf(Parameter::class);
		$this->setValue('null')->shouldBeAnInstanceOf(Parameter::class);

		$this->getName()->shouldBe('fooTwo');
		$this->getType()->shouldBe('string');
		$this->getValue()->shouldBe('null');
	}
}
