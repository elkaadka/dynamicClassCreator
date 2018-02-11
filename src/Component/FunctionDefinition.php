<?php

namespace Kanel\Enuma\Component;

class FunctionDefinition extends Definition
{
    protected $name;
    protected $visibility;
    protected $hasBody = true;
    protected $isAbstract = false;
    protected $isFinal = false;
    protected $isStatic = false;
    protected $parameters = [];
    protected $returnType = '';

    public function __construct(string $name, string $visibility)
    {
        $this->name = $name;
        $this->visibility = new Visibility($visibility);
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
     * @return FunctionDefinition
     */
    public function setName(string $name): FunctionDefinition
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
     * @return FunctionDefinition
     */
    public function setVisibility(string $visibility): FunctionDefinition
    {
        $this->visibility = new Visibility($visibility);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasBody(): bool
    {
        return $this->hasBody;
    }

    /**
     * @param bool $hasBody
     * @return FunctionDefinition
     */
    public function setHasBody(bool $hasBody): FunctionDefinition
    {
        $this->hasBody = $hasBody;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    /**
     * @param bool $isAbstract
     * @return FunctionDefinition
     */
    public function setIsAbstract(bool $isAbstract): FunctionDefinition
    {
        $this->isAbstract = $isAbstract;
        $this->isFinal = ($isAbstract === true)? false: $this->isFinal;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    /**
     * @param bool $isFinal
     * @return FunctionDefinition
     */
    public function setIsFinal(bool $isFinal): FunctionDefinition
    {
        $this->isFinal = $isFinal;
        $this->isAbstract = ($isFinal === true)? false: $this->isAbstract;

        return $this;
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
     * @return FunctionDefinition
     */
    public function setIsStatic(bool $isStatic): FunctionDefinition
    {
        $this->isStatic = $isStatic;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return FunctionDefinition
     */
    public function setParameters(array $parameters): FunctionDefinition
    {
        $this->parameters = array_filter($parameters, function($parameter) {
            return $parameter instanceof ParameterDefinition;
        });

        return $this;
    }

    /**
     * @param ParameterDefinition $parameter
     * @return FunctionDefinition
     */
    public function addParameter(ParameterDefinition $parameter): FunctionDefinition
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    /**
     * @return string
     */
    public function getReturnType(): string
    {
        return $this->returnType;
    }

    /**
     * @param string $returnType
     * @return FunctionDefinition
     */
    public function setReturnType(string $returnType): FunctionDefinition
    {
        $this->returnType = $returnType;

        return $this;
    }
}