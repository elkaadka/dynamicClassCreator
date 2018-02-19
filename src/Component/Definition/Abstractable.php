<?php

namespace Kanel\Enuma\Component\Definition;

interface Abstractable
{
	public function isAbstract(): bool;

	public function setIsAbstract(bool $abstract);
}