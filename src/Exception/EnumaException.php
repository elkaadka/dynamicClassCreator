<?php
namespace Kanel\Enuma\Exception;

use Throwable;

class EnumaException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}