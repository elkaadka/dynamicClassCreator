<?php

namespace Kanel\Enuma\Component\Atoms;

trait Static_
{
	protected $isStatic = false;

	/**
	 * @return bool
	 */
	public function isStatic(): bool
	{
		return $this->isStatic;
	}

	/**
	 * @param bool $isStatic
	 * @return $this
	 */
	public function setIsStatic(bool $isStatic)
	{
		$this->isStatic = $isStatic;

		return $this;
	}


}