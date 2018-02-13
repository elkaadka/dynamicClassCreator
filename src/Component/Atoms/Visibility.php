<?php

namespace Kanel\Enuma\Component\Atoms;

use Kanel\Enuma\Exception\EnumaException;
use Kanel\Enuma\Hint\VisibilityHint;

trait Visibility
{
	protected $visibility = \Kanel\Enuma\Hint\VisibilityHint::NONE;

	public function getVisibility(): string
	{
		return $this->visibility;
	}

	public function setVisibility(string $visibility)
	{
		if (!in_array($visibility, [VisibilityHint::PRIVATE, VisibilityHint::PROTECTED, VisibilityHint::PUBLIC, VisibilityHint::NONE])) {
			throw new EnumaException('Unknown visibility ' . $visibility);
		}

		$this->visibility = $visibility;

		return $this;
	}
}