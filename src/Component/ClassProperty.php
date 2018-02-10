<?php

namespace Kanel\Dynamic\Component;

class ClassProperty extends Component
{
    protected $visibility;
    protected $isStatic = false;
    protected $defaultValue;

    public function __construct(string $name, string $visibility, string $defaultValue = null, bool $isStatic = false)
    {
        parent::__construct($name);
        $this->visibility = $visibility;
        $this->defaultValue = $defaultValue;
        $this->isStatic = $isStatic;
    }

    public function __toString(): string
    {
        return $this->visibility . ' ' .
            ($this->isStatic ? 'static ': '') .
            '$' . $this->name .
            ($this->defaultValue ? ' = ' . $this->defaultValue : '') .
            ';'
        ;
    }

    /**
     * @param string $visibility
     * @return ClassProperty
     */
    public function setVisibility(string $visibility): ClassProperty
    {
        $this->visibility = $visibility;
    }

    /**
     * @param bool $isStatic
     * @return ClassProperty
     */
    public function setIsStatic(bool $isStatic): ClassProperty
    {
        $this->isStatic = $isStatic;
    }

    /**
     * @param string $defaultValue
     * @return ClassProperty
     */
    public function setDefaultValue(string $defaultValue): ClassProperty
    {
        $this->defaultValue = $defaultValue;
    }


}