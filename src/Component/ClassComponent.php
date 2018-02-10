<?php

namespace Kanel\Dynamic\Component;

class ClassComponent extends Component
{
    protected $docComment;

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }

    /**
     * @param string $docComment
     * @return ClassComponent
     */
    public function setDocComment(string $docComment): ClassComponent
    {
        $this->docComment = $docComment;

        return $this;
    }


}