<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Comment;
use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Atoms\Static_;
use Kanel\Enuma\Component\Atoms\Value;
use Kanel\Enuma\Component\Atoms\Visibility;
use Kanel\Enuma\Definition\Commentable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Definition\Staticable;
use Kanel\Enuma\Definition\Valuable;
use Kanel\Enuma\Definition\Visible;

class Property extends Component implements Nameable, Visible, Valuable, Staticable, Commentable
{
    use Name;
    use Visibility;
    use Value;
    use Static_;
    use Comment;

    public function __construct(string $name, string $visibility, string $defaultValue = null, bool $isStatic = false)
    {
    	$this->setName($name);
    	$this->setVisibility($visibility);
    	$this->setValue($defaultValue);
    	$this->setIsStatic($isStatic);
    }
}
