<?php

namespace Kanel\Enuma\Component\Definition;

interface Typable
{
	public function getType();

	public function setType(string $type);
}