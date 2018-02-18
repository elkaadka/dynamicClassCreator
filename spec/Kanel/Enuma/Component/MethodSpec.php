<?php

namespace spec\Kanel\Enuma\Component;

use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Parameter;
use Kanel\Enuma\Exception\EnumaException;
use Kanel\Enuma\Hint\VisibilityHint;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MethodSpec extends ObjectBehavior
{
	function it_should_at_least_be_constructed_with_name_and_visibility()
	{
		$this->beConstructedWith('name', VisibilityHint::PUBLIC);
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
	}

    function it_should_be_possible_to_define_protected_visibility()
    {
        $this->beConstructedWith('name', VisibilityHint::PROTECTED);
        $this->getName()->shouldBe('name');
        $this->getVisibility()->shouldBe(VisibilityHint::PROTECTED);
    }

    function it_should_be_possible_to_define_private_visibility()
    {
        $this->beConstructedWith('name', VisibilityHint::PRIVATE);
        $this->getName()->shouldBe('name');
        $this->getVisibility()->shouldBe(VisibilityHint::PRIVATE);
    }

	function it_should_fallback_to_no_visibility_if_unknown_visibility()
	{
		$this->beConstructedWith('name', 'random_visibility');
        $this->getName()->shouldBe('name');
        $this->getVisibility()->shouldBe(VisibilityHint::NONE);
	}

	function it_should_be_possible_to_tell_if_function_is_abstract()
	{
		$this->beConstructedWith('name', VisibilityHint::PUBLIC);

		$this->isAbstract()->shouldBe(false);
		$this->setIsAbstract(true)->shouldBeAnInstanceOf(Method::class);
		$this->isAbstract()->shouldBe(true);
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
        $this->getName()->shouldBe('name');
	}

	function it_should_be_possible_to_tell_if_function_is_final()
	{
		$this->beConstructedWith('name', VisibilityHint::PUBLIC);

		$this->isFinal()->shouldBe(false);
		$this->setIsFinal(true)->shouldBeAnInstanceOf(Method::class);
		$this->isFinal()->shouldBe(true);
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
        $this->getName()->shouldBe('name');
	}

	function it_should_be_possible_to_tell_if_function_is_static()
	{
		$this->beConstructedWith('name', VisibilityHint::PUBLIC);

		$this->isStatic()->shouldBe(false);
		$this->setIsStatic(true)->shouldBeAnInstanceOf(Method::class);
		$this->isStatic()->shouldBe(true);
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
        $this->getName()->shouldBe('name');
	}

	function it_should_be_possible_to_define_a_return_type()
	{
		$this->beConstructedWith('name', VisibilityHint::PUBLIC);

		$this->getType()->shouldBe(null);
		$this->setType('bool')->shouldBeAnInstanceOf(Method::class);
		$this->getType()->shouldBe('bool');
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
        $this->getName()->shouldBe('name');
	}

	function it_should_be_possible_to_add_parameters()
	{
		$this->beConstructedWith('name', VisibilityHint::PUBLIC);
		$fooParameter = new Parameter('foor');
		$barParameter = new Parameter('bar');

		$this->addParameter($fooParameter);
		$this->addParameter($barParameter);

		$this->getParameters()->shouldIterateAs([$fooParameter, $barParameter]);
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
        $this->getName()->shouldBe('name');
	}

	function it_should_be_possible_to_bulk_set_parameters()
	{
		$this->beConstructedWith('name', VisibilityHint::PUBLIC);
		$fooParameter = new Parameter('foor');
		$barParameter = new Parameter('bar');

		$this->setParameters([$fooParameter, $barParameter]);
		$this->getParameters()->shouldIterateAs([$fooParameter, $barParameter]);
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
        $this->getName()->shouldBe('name');
	}

    function it_should_be_possible_to_add_comments()
    {
        $this->beConstructedWith('name', VisibilityHint::PUBLIC);
        $fooParameter = new Parameter('foor');
        $barParameter = new Parameter('bar');

        $this->setParameters([$fooParameter, $barParameter]);
        $this->getParameters()->shouldIterateAs([$fooParameter, $barParameter]);
        $this->getVisibility()->shouldBe(VisibilityHint::PUBLIC);
        $this->getName()->shouldBe('name');
        $this->setComment('This is my method comment');
        $this->getComment()->shouldBe('This is my method comment');
    }
}
