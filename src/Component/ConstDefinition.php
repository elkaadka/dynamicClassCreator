<?php

namespace Kanel\Enuma\Component;

class ConstDefinition extends Definition
{
    protected $name;
    protected $visibility;
    protected $value;

    public function __construct(string $name, string $value, string $visibility = Visibility::NONE)
    {
        $this->name = $name;
        $this->visibility = new Visibility($visibility);
        $this->value = $value;
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
     * @return ConstDefinition
     */
    public function setName(string $name): ConstDefinition
    {
        $this->name = $name;

        return $this;
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
     * @return ConstDefinition
     */
    public function setVisibility(string $visibility): ConstDefinition
    {
        $this->visibility = new Visibility($visibility);

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return ConstDefinition
     */
    public function setValue(string $value): ConstDefinition
    {
        $this->value = $value;

        return $this;
    }
}