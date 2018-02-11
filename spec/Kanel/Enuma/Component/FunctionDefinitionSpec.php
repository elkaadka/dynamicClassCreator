<?php

namespace spec\Kanel\Enuma\Component;

use Kanel\Enuma\Component\FunctionDefinition;
use Kanel\Enuma\Component\ParameterDefinition;
use Kanel\Enuma\Component\Visibility;
use Kanel\Enuma\Exception\EnumaException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FunctionDefinitionSpec extends ObjectBehavior
{
    function it_should_at_least_be_constructed_with_name_and_visibility()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);
    }

    function it_should_throw_and_exception_if_unknown_visibility()
    {
        $this->beConstructedWith('name', 'random_visibility');
        $this->shouldThrow(EnumaException::class)->duringInstantiation();
    }

    function it_should_be_possible_to_tell_if_function_has_body()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);

        $this->hasBody()->shouldBe(true);
        $this->setHasBody(false)->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->hasBody()->shouldBe(false);
    }

    function it_should_be_possible_to_tell_if_function_is_abstract()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);

        $this->isAbstract()->shouldBe(false);
        $this->setIsAbstract(true)->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->isAbstract()->shouldBe(true);
    }

    function it_should_be_possible_to_tell_if_function_is_final()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);

        $this->isFinal()->shouldBe(false);
        $this->setIsFinal(true)->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->isFinal()->shouldBe(true);
    }

    function it_should_be_possible_to_tell_if_function_is_static()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);

        $this->isStatic()->shouldBe(false);
        $this->setIsStatic(true)->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->isStatic()->shouldBe(true);
    }

    function it_should_be_possible_to_define_a_return_type()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);

        $this->getReturnType()->shouldBe('');
        $this->setReturnType('bool')->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->getReturnType()->shouldBe('bool');
    }

    function it_should_not_be_possible_to_be_abstract_and_final()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);

        $this->isAbstract()->shouldBe(false);
        $this->isFinal()->shouldBe(false);

        $this->setIsFinal(true)->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->isFinal()->shouldBe(true);
        $this->isAbstract()->shouldBe(false);

        $this->setIsAbstract(true)->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->isFinal()->shouldBe(false);
        $this->isAbstract()->shouldBe(true);

        $this->setIsFinal(true)->shouldBeAnInstanceOf(FunctionDefinition::class);
        $this->isFinal()->shouldBe(true);
        $this->isAbstract()->shouldBe(false);
    }

    function it_should_be_possible_to_add_parameters()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);
        $fooParameter = new ParameterDefinition('foor');
        $barParameter = new ParameterDefinition('bar');

        $this->addParameter($fooParameter);
        $this->addParameter($barParameter);

        $this->getParameters()->shouldIterateAs([$fooParameter, $barParameter]);

    }

    function it_should_be_possible_to_bulk_set_parameters()
    {
        $this->beConstructedWith('name', Visibility::PUBLIC);
        $fooParameter = new ParameterDefinition('foor');
        $barParameter = new ParameterDefinition('bar');

        $this->setParameters([$fooParameter, $barParameter]);
        $this->getParameters()->shouldIterateAs([$fooParameter, $barParameter]);

    }
}
