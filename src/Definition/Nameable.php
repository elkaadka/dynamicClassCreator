<?php

namespace Kanel\Enuma\Definition;

interface Nameable
{
	public function getName();

	public function setName(string $name);
}