<?php

namespace Kanel\Enuma\Tokenizer\ClassTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class ClassTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$class = $sections->getSection(Sections::CLASS_NAME);
		if (!$class) {
			return [];
		}

		$tokens = [];

		$tokens[] = [
			T_CLASS,
			'class',
		];

		$tokens[] = [
			T_WHITESPACE,
			' ',
		];

		$tokens[] = [
			T_STRING,
			$class,
		];

		return $tokens;
	}
}
