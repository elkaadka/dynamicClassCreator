<?php

namespace Kanel\Enuma\Definition;

interface Commentable
{
	public function getComment();

	public function setComment(string $comment);
}