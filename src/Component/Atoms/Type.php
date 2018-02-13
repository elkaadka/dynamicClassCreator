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
	 * @return $this;
	 */
	public function setType(string $type)
	{
		$this->type = $type;

		return $this;
	}


}