<?php

namespace Kanel\Enuma\Component\Atoms;

trait Abstract_
{
	protected $isAbstract = false;

	/**
	 * @return bool
	 */
	public function isAbstract(): bool
	{
		return $this->isAbstract;
	}

	/**
	 * @param bool $isAbstract
	 * @return $this
	 */
	public function setIsAbstract(bool $isAbstract)
	{
		$this->isAbstract = $isAbstract;

		return $this;
	}
}