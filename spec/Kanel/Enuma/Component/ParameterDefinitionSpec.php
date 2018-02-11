<?php

namespace spec\Kanel\Enuma\Component;

use Kanel\Enuma\Component\ParameterDefinition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParameterDefinitionSpec extends ObjectBehavior
{
    function it_needs_at_least_a_name()
    {
        $this->beConstructedWith('foo');
    }

    function it_can_be_defined_with_a_type_and_a_default_value()
    {
        $this->beConstructedWith('foo', 'bool', 'true');
    }
}
