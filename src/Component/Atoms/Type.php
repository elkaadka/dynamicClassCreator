<?php

namespace Kanel\Enuma\Component\Atoms;

trait Type
{
	protected $type;

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $type
     * @param bool $isNullable
	 * @return $this;
	 */
	public function setType(string $type, bool $isNullable = false)
	{
		$this->type = ($isNullable? '?':'') . $type;

		return $this;
	}


}