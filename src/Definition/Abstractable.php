<?php

namespace Kanel\Enuma\Definition;

interface Abstractable
{
	public function isAbstract(): bool;

	public function setIsAbstract(bool $abstract);
}