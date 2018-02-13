<?php

namespace Kanel\Enuma\Definition;

interface Finalable
{
	public function isFinal(): bool;

	public function setIsFinal(bool $isFinal);
}