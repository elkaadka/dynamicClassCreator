<?php

namespace Kanel\Enuma\Definition;

interface Staticable
{
	public function isStatic(): bool;

	public function setIsStatic(bool $isFinal);
}