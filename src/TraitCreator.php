<?php

namespace Kanel\Enuma;

use Kanel\Enuma\Component\Method;
use Kanel\Enuma\Component\Property;
use Kanel\Enuma\Exception\EnumaException;

class TraitCreator extends ClassCreator
{
	const KEYWORD = 'interface';

	/**
	 * @throws EnumaException
	 */
	public function makeAbstract()
	{
		throw new EnumaException('Traits cannot be abstract');
	}

	/**
	 * @throws EnumaException
	 */
	public function makeFinal()
	{
		throw new EnumaException('Traits cannot be final');
	}

	/**
	 * @param string $className
	 * @throws EnumaException
	 */
	public function extends(string $className)
	{
		throw new EnumaException('Traits cannot extend classes');
	}

	/**
	 * @param string $className
	 * @throws EnumaException
	 */
	public function implements(string $className)
	{
		throw new EnumaException('Traits cannot implement interfaces');
	}

	/**
	 * @param string $trait
	 * @throws EnumaException
	 */
	public function useTrait(string $trait)
	{
		throw new EnumaException('Traits cannot be traits');
	}

	/**
	 * @param Property $property
	 * @throws EnumaException
	 */
	public function addProperty(Property $property)
	{
		throw new EnumaException('Traits cannot have properties');
	}

	/**
	 * @param Property $property
	 * @throws EnumaException
	 */
	public function addConst(Property $property)
	{
		throw new EnumaException('Traits cannot have properties');
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
