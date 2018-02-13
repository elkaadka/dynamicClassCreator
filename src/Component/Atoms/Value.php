<?php

namespace Kanel\Enuma\Component\Atoms;

trait Value
{
	protected $value = null;

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param mixed $value
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}


}