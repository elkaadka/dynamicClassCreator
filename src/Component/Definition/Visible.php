<?php

namespace Kanel\Enuma\Component\Definition;

interface Visible
{
	public function getVisibility();

	public function setVisibility(string $visibility);
}