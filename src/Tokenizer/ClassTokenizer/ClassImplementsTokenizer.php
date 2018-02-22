<?php

namespace Kanel\Enuma\Tokenizer\ClassTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class ClassImplementsTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$implements = $sections->getSection(Sections::CLASS_IMPLEMENTED_CLASSES_SECTION);
		if (!$implements) {
			return [];
		}

		$tokens = [];

		$tokens[] = [
			T_WHITESPACE,
			' '
		];

		$tokens[] = [
			T_IMPLEMENTS,
			'implements'
		];

		$tokens[] = [
			T_WHITESPACE,
			' '
		];

		foreach ($implements as $implement) {

			$tokens[] = [
				T_STRING,
				$implement
			];

			$tokens[] = ',';

			$tokens[] = [
				T_WHITESPACE,
				' '
			];
		}

		//remove the last , and whitespace
		array_pop($tokens);
		array_pop($tokens);

		return $tokens;
	}
}
