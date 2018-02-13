<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Atoms\Type;
use Kanel\Enuma\Component\Atoms\Value;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Definition\Typable;
use Kanel\Enuma\Definition\Valuable;

class Parameter extends Component implements Typable, Nameable, Valuable
{
	use Type;
	use Name;
	use Value;

    public function __construct(string $name, string $type = null, string $defaultValue = null)
    {
        $this->setName($name);
        $this->setType($type ?? '');
        $this->setValue($defaultValue ?? '');
    }
}
