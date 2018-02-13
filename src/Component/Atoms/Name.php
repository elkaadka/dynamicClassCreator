<?php

namespace Kanel\Enuma\Component\Atoms;

trait Name
{
	protected $name;

	public function getName()
	{
		return $this->name;
	}

	public function setName(string $name)
	{
		$this->name = $name;

		return $this;
	}
}