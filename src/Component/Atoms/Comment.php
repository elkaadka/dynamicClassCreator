<?php

namespace Kanel\Enuma\Component\Atoms;

trait Comment
{
    protected $comment;

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }
}
