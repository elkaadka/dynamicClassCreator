<?php

namespace Kanel\Enuma\Helper;

trait ClassNameExtractor
{
    protected static function extractType(string $class)
    {
        $namespace = '';

        if (strpos($class, '\\') !== false) {
            $namespace = $class;
        }

        $classBaseName = basename(str_replace('\\', '/', $class));

        return [$namespace, $classBaseName];
    }
}