<?php

namespace Kanel\Dynamic\Component;

interface Commentable
{
    public function getDocComment();

    public function setDocComment(string $docComment);
}