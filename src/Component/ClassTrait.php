<?php

namespace Kanel\Dynamic\Component;

class ClassTrait extends Component
{
    public function __toString(): string
    {
        return 'trait ' . $this->name . ';';
    }

}