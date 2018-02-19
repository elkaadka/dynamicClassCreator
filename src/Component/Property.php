<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Atoms\Static_;
use Kanel\Enuma\Component\Atoms\Value;
use Kanel\Enuma\Component\Atoms\Visibility;
use Kanel\Enuma\Component\Definition\Nameable;
use Kanel\Enuma\Component\Definition\Staticable;
use Kanel\Enuma\Component\Definition\Valuable;
use Kanel\Enuma\Component\Definition\Visible;

class Property extends Component implements Nameable, Visible, Valuable, Staticable
{
    use Name;
    use Visibility;
    use Value;
    use Static_;

    public function __construct(string $name, string $visibility, string $defaultValue = null, bool $isStatic = false)
    {
    	$this->setName($name);
    	$this->setVisibility($visibility);
    	$this->setValue($defaultValue);
    	$this->setIsStatic($isStatic);
    }
}
