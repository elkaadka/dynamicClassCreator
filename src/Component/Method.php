<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Abstract_;
use Kanel\Enuma\Component\Atoms\Comment;
use Kanel\Enuma\Component\Atoms\Final_;
use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Atoms\Static_;
use Kanel\Enuma\Component\Atoms\Type;
use Kanel\Enuma\Component\Atoms\Visibility;
use Kanel\Enuma\Definition\Abstractable;
use Kanel\Enuma\Definition\Commentable;
use Kanel\Enuma\Definition\Finalable;
use Kanel\Enuma\Definition\Nameable;
use Kanel\Enuma\Definition\Staticable;
use Kanel\Enuma\Definition\Typable;
use Kanel\Enuma\Definition\Visible;

class Method extends Component implements Nameable, Visible, Typable, Abstractable, Finalable, Staticable, Commentable
{
	use Name;
	use Visibility;
	use Abstract_;
	use Final_;
	use Static_;
	use Type;
	use Comment;

    protected $parameters = [];

    public function __construct(string $name, string $visibility)
    {
        $this->setName($name);
        $this->setVisibility($visibility);
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return Method
     */
    public function setParameters(array $parameters): Method
    {
        $this->parameters = array_filter($parameters, function($parameter) {
            return $parameter instanceof Parameter;
        });

        return $this;
    }

    /**
     * @param Parameter $parameter
     * @return Method
     */
    public function addParameter(Parameter $parameter): Method
    {
        $this->parameters[] = $parameter;

        return $this;
    }
}
