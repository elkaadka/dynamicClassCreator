<?php

namespace spec\Kanel\Enuma;

use Kanel\Enuma\CodingStyle\Psr2;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Constant;
use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Parameter;
use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Hint\TypeHint;
use Kanel\Enuma\Hint\VisibilityHint;
use PhpSpec\ObjectBehavior;
use PhpSpec\Wrapper\Subject;
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

    function it_should_be_possible_to_use_a_class()
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

    function it_should_be_possible_to_use_multiple_classes()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use(Argument::class, Subject::class);
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use PhpSpec\Wrapper\Subject;

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

    function it_should_be_possible_to_create_a_final_class()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

final class Foo
{
}

'
        );
    }


    function it_should_be_either_final_or_abstract()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
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

    function it_should_be_possible_to_create_just_a_class()
    {
        $this->class('Foo');
        $this->toString()->shouldReturn(
            '<?php

class Foo
{
}

'
        );
    }


    function it_should_be_possible_to_extend_a_class()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->extends(self::class);
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;

final class Foo extends ClassCreatorSpec
{
}

'
        );
    }

    function it_should_be_possible_to_add_a_single_line_class_comment()
    {
		$this->namespace('spec\Kanel\Enuma');
		$this->use('Prophecy\Argument');
		$this->class('Foo');
		$this->final();
		$this->comment('This is my comment and it takes one line');
		$this->extends(self::class);
		$this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;

/**
 * This is my comment and it takes one line
 */
final class Foo extends ClassCreatorSpec
{
}

'
        );
    }

    function it_should_be_possible_to_add_a_multi_line_class_comment()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec
{
}

'
        );
    }

    function it_should_be_possible_to_implement_an_interface()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class);
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable
{
}

'
        );
    }

    function it_should_be_possible_to_implement_multiple_interfaces()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
}

'
        );
    }

    function it_should_be_possible_to_use_one_trait()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class);
        $this->useTraits(Final_::class);
		$this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Component\Atoms\Final_;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable
{
    use Final_;
}

'
        );
    }

    function it_should_be_possible_to_use_many_traits()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);
        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;
}

'
        );
    }

    function it_should_be_possible_to_add_a_constant()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->addConst(new Constant('MY_CONST', 'true'));
		echo $this->toString()->getWrappedObject();exit;

		$this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    const MY_CONST = true;
}

'
        );
    }

    function it_should_be_possible_to_add_multiple_constants()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment' . "\n" . "and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);
        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst(new Constant('MY_SECOND_CONST', 'Hello'));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECOND_CONST = \'Hello\';
}

'
        );
    }

    function it_should_be_possible_to_add_a_property()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

/**
 * This is my comment
 * and this the rest
 */
class Foo
{
    protected $test;
}

'
        );
    }

    function it_should_be_possible_to_add_static_a_property()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->addProperty(new Property('test', VisibilityHint::PROTECTED, null, true));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

/**
 * This is my comment
 * and this the rest
 */
class Foo
{
    protected static $test;
}

'
        );
    }

    function it_should_be_possible_to_add_defaut_value_to_a_property()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->addProperty(new Property('test', VisibilityHint::PROTECTED, 'Hello', true));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

/**
 * This is my comment
 * and this the rest
 */
class Foo
{
    protected static $test = \'Hello\';
}

'
        );
    }

    function it_should_be_possible_to_add_properties()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;

/**
 * This is my comment
 * and this the rest
 */
class Foo
{
    protected $test;
    protected $testTwo;
}

'
        );
    }

    function it_should_correctly_print_properties_with_consts_and_traits()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;
}

'
        );
    }

    function it_should_be_possible_to_add_a_functions()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $this->addFunction(new Method('sayHello', VisibilityHint::PUBLIC));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;

    public function sayHello()
    {

    }
}

'
        );
    }

    function it_should_be_possible_to_add_many_functions()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $this->addFunction(new Method('sayHello', VisibilityHint::PUBLIC));
        $this->addFunction(new Method('Bar', VisibilityHint::PROTECTED));

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;

    public function sayHello()
    {

    }

    protected function Bar()
    {

    }
}

'
        );
    }

    function it_should_be_possible_to_add_many_functions_with_comments()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $method = new Method('sayHello', VisibilityHint::PUBLIC);
        $method->setComment('This is my cool function');
        $this->addFunction($method);

        $method2 = new Method('Bar', VisibilityHint::PROTECTED);
        $method2->setComment('This is my second cool function');
        $this->addFunction($method2);

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;

    /**
     * This is my cool function
     */
    public function sayHello()
    {

    }

    /**
     * This is my second cool function
     */
    protected function Bar()
    {

    }
}

'
        );
    }

    function it_should_be_possible_to_add_an_abstract__or_final_function()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $method = new Method('sayHello', VisibilityHint::PUBLIC);
        $method->setComment('This is my cool function');
        $method->setIsAbstract(true);
        $this->addFunction($method);

        $method2 = new Method('Bar', VisibilityHint::PROTECTED);
        $method2->setComment('This is my second cool function');
        $method2->setIsFinal(true);
        $this->addFunction($method2);

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;

    /**
     * This is my cool function
     */
    abstract public function sayHello();

    /**
     * This is my second cool function
     */
    final protected function Bar()
    {

    }
}

'
        );
    }

    function it_should_be_possible_to_add_a_method_with_a_return_type()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $method = new Method('sayHello', VisibilityHint::PUBLIC);
        $method->setComment('This is my cool function');
        $method->setType(TypeHint::ARRAY);
        $this->addFunction($method);

        $method2 = new Method('Bar', VisibilityHint::PROTECTED);
        $method2->setComment('This is my second cool function');
        $this->addFunction($method2);

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;

    /**
     * This is my cool function
     * @return array
     */
    public function sayHello(): array
    {

    }

    /**
     * This is my second cool function
     */
    protected function Bar()
    {

    }
}

'
        );
    }

    function it_should_be_possible_to_add_a_method_with_a_class_return_type()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $method = new Method('sayHello', VisibilityHint::PUBLIC);
        $method->setComment('This is my cool function');
        $method->setType(TypeHint::class);
        $this->addFunction($method);

        $method2 = new Method('Bar', VisibilityHint::PROTECTED);
        $method2->setComment('This is my second cool function');
        $this->addFunction($method2);

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Hint\TypeHint;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;

    /**
     * This is my cool function
     * @return TypeHint
     */
    public function sayHello(): TypeHint
    {

    }

    /**
     * This is my second cool function
     */
    protected function Bar()
    {

    }
}

'
        );
    }

    function it_should_be_possible_to_add_a_method_with_parameters()
    {
        $this->namespace('spec\Kanel\Enuma');
        $this->use('Prophecy\Argument');
        $this->class('Foo');
        $this->final();
        $this->comment('This is my comment'."\n"."and this the rest");
        $this->extends(self::class);
        $this->implements(Finalable::class, Nameable::class);
        $this->useTraits(Final_::class, Name::class);

        $this->addConst(new Constant('MY_FIRST_CONST', 'true'));
        $this->addConst( new Constant('MY_SECONDNST', 'true'));
        $this->addConst(new Constant('MY_THIRD_CONST', 'true'));

        $this->addProperty(new Property('test', VisibilityHint::PROTECTED));
        $this->addProperty(new Property('testTwo', VisibilityHint::PROTECTED));

        $method = new Method('sayHello', VisibilityHint::PUBLIC);
        $method->setComment('This is my cool function');
        $method->setType(TypeHint::class);
        $method->addParameter(new Parameter('param1', TypeHint::STRING, 'true'));
        $method->addParameter(new Parameter('param2', TypeHint::NONE, 'true'));
        $method->addParameter(new Parameter('param3', VisibilityHint::class, 'null'));
        $this->addFunction($method);

        $method2 = new Method('Bar', VisibilityHint::PROTECTED);
        $method2->setComment('This is my second cool function');
        $this->addFunction($method2);

        $this->toString()->shouldReturn(
            '<?php

namespace spec\Kanel\Enuma;

use Prophecy\Argument;
use spec\Kanel\Enuma\ClassCreatorSpec;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Hint\VisibilityHint;
use Kanel\Enuma\Hint\TypeHint;

/**
 * This is my comment
 * and this the rest
 */
final class Foo extends ClassCreatorSpec implements Finalable, Nameable
{
    use Final_;
    use Name;

    const MY_FIRST_CONST = true;
    const MY_SECONDNST = true;
    const MY_THIRD_CONST = true;

    protected $test;
    protected $testTwo;

    /**
     * This is my cool function
     * @param string $param1
     * @param mixed $param2
     * @param VisibilityHint $param3
     * @return TypeHint
     */
    public function sayHello(string $param1 = \'true\', $param2 = true, VisibilityHint $param3 = null): TypeHint
    {

    }

    /**
     * This is my second cool function
     */
    protected function Bar()
    {

    }
}

'
        );
    }
}
