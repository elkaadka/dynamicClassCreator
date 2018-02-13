<?php

namespace Kanel\Enuma;

use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Exception\EnumaException;

class InterfaceCreator extends ClassCreator
{
    const KEYWORD = 'interface';

    /**
     * @throws EnumaException
     */
    public function makeAbstract()
    {
        throw new EnumaException('interfaces cannot be abstract');
    }

    /**
     * @throws EnumaException
     */
    public function makeFinal()
    {
        throw new EnumaException('interfaces cannot be final');
    }

    /**
     * @param string $className
     * @throws EnumaException
     */
    public function extends(string $className)
    {
        throw new EnumaException('interfaces cannot extend classes');
    }

    /**
     * @param string $className
     * @throws EnumaException
     */
    public function implements(string $className)
    {
        throw new EnumaException('interfaces cannot implement other interfaces');
    }

    /**
     * @param string $trait
     * @throws EnumaException
     */
    public function useTrait(string $trait)
    {
        throw new EnumaException('interfaces cannot be traits');
    }

    /**
     * @param Property $property
     * @throws EnumaException
     */
    public function addProperty(Property $property)
    {
        throw new EnumaException('interfaces cannot have properties');
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
