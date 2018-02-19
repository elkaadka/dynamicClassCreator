<?php

namespace Kanel\Enuma\Helper;

use Kanel\Enuma\Hint\TypeHint;

trait ValuePrinter
{
    public static function printValue(string $value, string $type = '')
    {
        if (
            $type != TypeHint::STRING &&
            (
                is_numeric($value) ||
                in_array($value, ['true', 'false', 'null']) ||
                strpos($value, 'array(') === 0 ||
                strpos($value, '[') === 0
            )
        ) {
            return $value;
        }

        return "'" . str_replace('\'', '\\\'', $value) . "'";
    }
}