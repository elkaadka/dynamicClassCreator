<?php

namespace Kanel\Dynamic\Component;

abstract class Component implements ComponentInterface
{
    protected $name;
    protected $

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}