<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Abstract_;
use Kanel\Enuma\Component\Atoms\Comment;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Definition\Abstractable;
use Kanel\Enuma\Component\Definition\Commentable;
use Kanel\Enuma\Component\Definition\Finalable;
use Kanel\Enuma\Component\Definition\Nameable;

class Class_ extends Component implements Abstractable, Finalable, Nameable, Commentable
{
	use Abstract_;
	use Final_;
	use Name;
	use Comment;

	const TYPE_CLASS = 'class';
	const TYPE_INTERFACE = 'interface';
	const TYPE_TRAIT = 'trait';

	protected $namespace;
	protected $use = [];
	protected $classType;
	protected $extends;
	protected $implements = [];
	protected $traits = [];
	protected $consts = [];
	protected $properties = [];
	protected $methods = [];

	public function __construct(string $name)
	{
		$this->setName($name);
	}

	public function setClassType(string $classType)
	{
		if (!in_array($classType, [self::TYPE_CLASS, self::TYPE_INTERFACE, self::TYPE_TRAIT])) {
			$this->classType = self::TYPE_CLASS;
		} else {
			$this->classType = $classType;
		}

		return $this;
	}

	public function getNamespace()
	{
		return $this->namespace;
	}

	public function setNamespace(Namespace_ $namespace)
	{
		$this->namespace = $namespace;
	}

	public function getUse()
	{
		return $this->use;
	}

	public function setUse(Use_ $use)
	{
		$this->use[] = $use;
	}

	public function getExtend()
	{
		return $this->extends;
	}

	public function setExtend(Extend_ $class)
	{
		$this->extends = $class;

		return $this;
	}

	public function getImplements(): array
	{
		return $this->implements;
	}

	public function setImplement(Interface_ $interface)
	{
		$this->implements[] = $interface;

		return $this;
	}

	public function getTraits(): array
	{
		return $this->traits;
	}

	public function setTrait(Trait_ $trait)
	{
		$this->traits[] = $trait;
	}

	public function getConsts(): array
	{
		return $this->consts;
	}

	public function setConst(Constant $const)
	{
		$this->consts[] = $const;
	}

	public function getProperties(): array
	{
		return $this->properties;
	}

	public function setProperty(Property $property)
	{
		$this->properties[] = $property;
	}

	public function getMethods(): array
	{
		return $this->methods;
	}

	public function setMethod(Method $method)
	{
		$this->methods[] = $method;
	}
}
