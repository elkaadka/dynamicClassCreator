<?php

namespace Kanel\Enuma\Tokenizer\ClassTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class ClassEndTokenizer implements Tokenizable
{
	use CommentGeneration;

	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$classSection = $sections->getSection(Sections::CLASS_NAME);
		if (!$classSection) {
			return '';
		}

		return $codingStyle->getNewLine()
			. '}'
			. $codingStyle->getNewLine();

	}
}