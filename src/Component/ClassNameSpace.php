<?php

namespace Kanel\Dynamic\Component;

class ClassNameSpace extends Component
{
    public function __toString(): string
    {
        return 'namespace ' . $this->name;
    }
}