<?php

namespace Kanel\Enuma\Helpers;

trait ValuePrinter
{
    public function printValue(string $value)
    {
        if (
            is_numeric($value) ||
            in_array($value, ['true', 'false', 'null']) ||
            strpos($value, 'array(') === 0 ||
            strpos($value, '[') === 0
        ) {
            return $value;
        }

        return str_replace('\'', '\\\'', $value);
    }
}