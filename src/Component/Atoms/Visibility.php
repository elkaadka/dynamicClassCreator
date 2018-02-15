<?php

namespace Kanel\Enuma\Component\Atoms;

use Kanel\Enuma\Hint\VisibilityHint;

trait Visibility
{
	protected $visibility = VisibilityHint::PUBLIC;

	public function getVisibility(): string
	{
		return $this->visibility;
	}

	public function setVisibility(string $visibility)
	{
		if (!in_array($visibility, VisibilityHint::getAll())) {
			$visibility = VisibilityHint::NONE;
		}

		$this->visibility = $visibility;

		return $this;
	}
}