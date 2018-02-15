<?php

namespace spec\Kanel\Enuma;

use Kanel\Enuma\ClassCreator;
use Kanel\Enuma\CodingStyle\Psr2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassCreatorSpec extends ObjectBehavior
{
    function it_should_set_default_coding_style_as_psr2()
    {
        $this->getCodingStyle()->shouldBeAnInstanceOf(Psr2::class);
    }

    function it_should_create_empty_php_file_on_construction()
    {
        $this->toString()->shouldReturn(
            '<?php
'
        );
    }

    function it_should_be_possible_add_namespaces()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->toString()->shouldReturn(
'<?php

namespace spec\Kanel\Enuma;

'
        );
    }

    function it_should_only_use_one_namespace()
    {
        $this->namespace('fake\Kanel\Enuma');
        $this->namespace('spec\Kanel\Enuma');
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

'
        );
    }

    function it_should_be_possible_to_use_classes()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

'
        );
    }

    function it_should_be_possible_to_create_a_class()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

class Foo
{
}

'
        );
    }

    function it_should_be_possible_to_create_an_abstract_class()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->abstract();
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

abstract class Foo
{
}

'
        );
    }
}
