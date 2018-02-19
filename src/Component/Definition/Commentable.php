<?php

namespace Kanel\Enuma\Component\Definition;

interface Commentable
{
	public function getComment();

	public function setComment(string $comment);
}