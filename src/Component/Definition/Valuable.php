<?php

namespace Kanel\Enuma\Component\Definition;

interface Valuable
{
	public function getValue();

	public function setValue($value);
}