<?php

namespace Kanel\Enuma\Component\Atoms;

trait Final_
{
	protected $isFinal = false;

	/**
	 * @return bool
	 */
	public function isFinal(): bool
	{
		return $this->isFinal;
	}

	/**
	 * @param bool $isFinal
	 * @return $this
	 */
	public function setIsFinal(bool $isFinal)
	{
		$this->isFinal = $isFinal;

		return $this;
	}


}