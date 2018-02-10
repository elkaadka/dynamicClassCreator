<?php

namespace Kanel\Dynamic\Component;

class ClassConst extends Component
{
    protected $value;

    public function __construct(string $name, string $value)
    {
        parent::__construct($name);
        $this->value = $value;
    }

    public function __toString(): string
    {
        return 'const ' . $this->name . ' = ' .
            (is_numeric($this->value)? $this->value : "\'". str_replace("'", "\'", $this-$this->value) ."\'")
            ;
    }

}