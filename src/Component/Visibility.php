<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Exception\EnumaException;

class Visibility
{
    const PRIVATE = 'private';
    const PROTECTED = 'protected';
    const PUBLIC = 'public';
    const NONE = '';

    protected $name;

    /**
     * Visibility constructor.
     * @param string $name
     * @throws EnumaException
     */
    public function __construct(string $name)
    {
        if (!in_array($name, [self::PRIVATE, self::PROTECTED, self::PUBLIC, self::NONE])) {
            throw new EnumaException('Unknown visibility ' . $name);
        }
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}
