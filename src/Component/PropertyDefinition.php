<?php

namespace Kanel\Enuma\Component;

class PropertyDefinition extends Definition
{
    protected $name;
    protected $visibility;
    protected $defaultValue;
    protected $isStatic;

    public function __construct(string $name, string $visibility, string $defaultValue = null, bool $isStatic = false)
    {
        $this->name = $name;
        $this->visibility = new Visibility($visibility);
        $this->defaultValue = $defaultValue;
        $this->isStatic = $isStatic;
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

    /**
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility->getName();
    }

    /**
     * @param string $visibility
     */
    public function setVisibility(string $visibility)
    {
        $this->visibility = new Visibility($visibility);
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return bool
     */
    public function isStatic(): bool
    {
        return $this->isStatic;
    }

    /**
     * @param bool $isStatic
     */
    public function setIsStatic($isStatic)
    {
        $this->isStatic = $isStatic;
    }
}
