<?php

namespace Kanel\Enuma;

use Kanel\Enuma\Component\FunctionDefinition;
use Kanel\Enuma\Component\PropertyDefinition;
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
    public function trait(string $trait)
    {
        throw new EnumaException('interfaces cannot be traits');
    }

    /**
     * @param PropertyDefinition $property
     * @throws EnumaException
     */
    public function addProperty(PropertyDefinition $property)
    {
        throw new EnumaException('interfaces cannot have properties');
    }

    /**
     * @param FunctionDefinition $function
     */
    public function addFunction(FunctionDefinition $function)
    {
        $function->setHasBody(false);
        parent::addFunction($function);
    }
}
