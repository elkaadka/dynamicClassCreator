<?php

namespace Kanel\Enuma\Component\Definition;

interface Nameable
{
	public function getName();

	public function setName(string $name);
}