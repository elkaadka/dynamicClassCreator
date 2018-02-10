<?php

namespace Kanel\Dynamic\Component;

class ClassFunction extends Component
{
    protected $visibility;
    protected $isStatic = false;
    protected $isAbstract = false;
    protected $isFinal = false;
    protected $returnType = '';
    protected $parameters = [];

    public function __construct(string $name, string $visibility)
    {
        parent::__construct($name);
        $this->visibility = $visibility;
    }

    public function __toString(): string
    {
        return
            ($this->isAbstract? 'abstract ': '') .
            ($this->isFinal? 'final ': '') .
            $this->visibility . ' ' .
            ($this->isStatic? 'static ': '') .
            'function ' .
            $this->name .
            '(' .
            rtrim(
                array_reduce(
                    $this->parameters,
                    function($carry, $parameter) {
                        $carry .= $parameter . ', ';
                    },
                    ''
                ),
                ', '
            ) .
            ')' .
            ($this->returnType? ': ' . $this->returnType: '')
            ;
    }

    /**
     * @param bool $isStatic
     * @return ClassFunction
     */
    public function setIsStatic(bool $isStatic): ClassFunction
    {
        $this->isStatic = $isStatic;
    }

    /**
     * @param bool $isAbstract
     * @return ClassFunction
     */
    public function setIsAbstract(bool $isAbstract): ClassFunction
    {
        $this->isAbstract = $isAbstract;
    }

    /**
     * @param bool $isFinal
     * @return ClassFunction
     */
    public function setIsFinal(bool $isFinal): ClassFunction
    {
        $this->isFinal = $isFinal;
    }

    /**
     * @param string $returnType
     * @return ClassFunction
     */
    public function setReturnType(string $returnType): ClassFunction
    {
        $this->returnType = $returnType;
    }

    /**
     * @param MethodParameter $parameter
     * @return ClassFunction
     */
    public function addParameter(MethodParameter $parameter): ClassFunction
    {
        $this->parameters[] = $parameter;
    }

}