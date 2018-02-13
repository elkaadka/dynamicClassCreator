<?php

namespace Kanel\Enuma\Hint;

class TypeHint
{
	const STRING = 'string';
	const INT = 'int';
	const FLOAT = 'float';
	const BOOL = 'bool';
	const ARRAY = 'array';
	const CALLABLE = 'callable';
	const STDCLASS = 'stdClass';
	const SELF = 'self';
	const PARENT = 'parent';
	const OBJECT = 'object';

	protected $name;

    public function __construct(string $name)
    {
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
	 * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
