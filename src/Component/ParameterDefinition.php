<?php

namespace Kanel\Enuma\Component;

class ParameterDefinition extends Definition
{
    protected $type;
    protected $name;
    protected $defaultValue;

    public function __construct(string $name, string $type = null, string $defaultValue = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
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
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @param string $defaultValue
     * @return $this
     */
    public function setDefaultValue(string $defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }
}