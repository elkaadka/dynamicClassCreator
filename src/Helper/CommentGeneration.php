<?php

namespace Kanel\Enuma\Helpers;

trait CommentGeneration
{
    protected function generateDocComment(string $comment = null, string $indentation, string $newLine): string
    {
        if (!$comment) {
            return '';
        }

        return
            $indentation . '/**' . $newLine .
            $indentation . ' * ' .  str_replace("\n", "\n * ", $comment) .
            $indentation . ' */'. $newLine;

    }
}