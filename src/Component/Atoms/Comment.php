<?php

namespace Kanel\Enuma\Component\Atoms;

use Kanel\Enuma\Component\Comment_;

trait Comment
{
    protected $comment;

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment(Comment_ $comment)
    {
        $this->comment = $comment;
    }
}
