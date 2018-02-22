<?php

namespace Kanel\Enuma\Component\Definition;

use Kanel\Enuma\Component\Comment_;

interface Commentable
{
	public function getComment();

	public function setComment(Comment_ $comment);
}