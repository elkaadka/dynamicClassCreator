<?php

namespace Kanel\Enuma\Hint;

abstract class Hint
{
    public static function getAll()
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }
}