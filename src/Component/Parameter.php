<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Comment;
use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Atoms\Type;
use Kanel\Enuma\Component\Atoms\Value;
use Kanel\Enuma\Definition\Commentable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Definition\Typable;
use Kanel\Enuma\Definition\Valuable;

class Parameter extends Component implements Typable, Nameable, Valuable, Commentable
{
	use Type;
	use Name;
	use Value;
	use Comment;

    public function __construct(string $name, string $type = null, string $defaultValue = null)
    {
        $this->setName($name);
        $this->setType($type ?? '');
        $this->setValue($defaultValue ?? '');
    }
}
