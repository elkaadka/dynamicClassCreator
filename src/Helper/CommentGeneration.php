<?php

namespace Kanel\Enuma\Helper;

trait CommentGeneration
{
    protected static function generateDocComment(string $comment = null, string $indentation, string $newLine): string
    {
        if (!$comment) {
            return '';
        }

        return
            $indentation . '/**' . $newLine .
            $indentation . ' * ' .  str_replace("\n", "\n". $indentation ." * ", $comment) .
            $newLine .
            $indentation . ' */'. $newLine;

    }
}