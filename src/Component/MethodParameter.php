<?php

namespace Kanel\Dynamic\Component;

class MethodParameter extends Component
{
    protected $type;
    protected $defaultValue = false;

    public function __construct(string $name, string $type = null, string $defaultValue = null)
    {
        parent::__construct($name);
        $this->type = $type;
        $this->defaultValue = $defaultValue;
    }

    public function __toString(): string
    {
        return
            ($this->type ? $this->type. ' ' : '') .
            $this->name .
            ($this->defaultValue? ' = ' . $this->defaultValue : '')
        ;
    }
}
