<?php

namespace Kanel\Enuma\Tokenizer\FunctionTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Component\Component;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class FunctionCommentTokenizer implements Tokenizable
{
	use CommentGeneration;

	public static function getTokens(Component $component, CodingStyle $codingStyle): array
	{
		$classSection = $sections->getSection(Sections::CLASS_NAME);
		if (!$classSection) {
			return [];
		}

		$tokens = [];

		$comment = self::generateDocComment(
			$sections->getSection(Sections::CLASS_COMMENT_SECTION),
			$codingStyle->getIndentation(),
			$codingStyle->getNewLine()
		);

		if ($comment) {
			$tokens[] = [
				T_DOC_COMMENT,
				$comment,
			];

			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getNewLine(),
			];
		}

		return $tokens;
	}
}
