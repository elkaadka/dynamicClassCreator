<?php

namespace Kanel\Enuma\Definition;

interface Typable
{
	public function getType();

	public function setType(string $type);
}