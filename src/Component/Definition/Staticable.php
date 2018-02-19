<?php

namespace Kanel\Enuma\Component\Definition;

interface Staticable
{
	public function isStatic(): bool;

	public function setIsStatic(bool $isFinal);
}