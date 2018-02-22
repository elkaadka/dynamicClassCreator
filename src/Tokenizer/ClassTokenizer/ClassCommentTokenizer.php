<?php

namespace Kanel\Enuma\Tokenizer\ClassTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class ClassCommentTokenizer implements Tokenizable
{
	use CommentGeneration;

	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$classSection = $sections->getSection(Sections::CLASS_NAME);
		if (!$classSection) {
			return [];
		}

		$tokens = [];

		$comment = self::generateDocComment(
			$sections->getSection(Sections::CLASS_COMMENT_SECTION),
			'',
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
