<?php

namespace Kanel\Enuma\Definition;

interface Valuable
{
	public function getValue();

	public function setValue($value);
}