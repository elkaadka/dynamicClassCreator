<?php

namespace Kanel\Enuma;

use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Exception\EnumaException;

class InterfaceCreator extends ClassCreator
{
    public function class(string $name)
    {
        $this->sections[static::CLASS_TYPE_SECTION] = 'interface';
        $this->sections[static::CLASS_NAME] = $name;
    }

    public function makeAbstract()
    {
        return;
    }

    public function makeFinal()
    {
        return;
    }

    public function extends(string $className)
    {
        return;
    }

    public function implements(string $className)
    {
        return;
    }

    public function useTrait(string $trait)
    {
        return;
    }

    public function addProperty(Property $property)
    {
        return;
    }

    /**
     * @param Method $function
     */
    public function addFunction(Method $function)
    {
        $function->setHasBody(false);
        parent::addFunction($function);
    }
}
