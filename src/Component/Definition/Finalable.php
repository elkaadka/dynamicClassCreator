<?php

namespace Kanel\Enuma\Component\Definition;

interface Finalable
{
	public function isFinal(): bool;

	public function setIsFinal(bool $isFinal);
}