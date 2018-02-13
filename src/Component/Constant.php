<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Atoms\Value;
use Kanel\Enuma\Component\Atoms\Visibility;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Definition\Valuable;
use Kanel\Enuma\Definition\Visible;
use Kanel\Enuma\Hint\VisibilityHint;

class Constant extends Component implements Nameable, Visible, Valuable
{
	use Name;
	use Visibility;
	use Value;

    public function __construct(string $name, string $value, string $visibility = VisibilityHint::NONE)
    {
    	$this->setName($name);
    	$this->setValue($value);
        $this->setVisibility($visibility);
    }
}