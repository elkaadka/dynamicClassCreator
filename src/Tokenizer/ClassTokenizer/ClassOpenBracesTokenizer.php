<?php

namespace Kanel\Enuma\Tokenizer\ClassTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class ClassOpenBracesTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$tokens = [];

		if ($codingStyle->isClassBracesInNewLine()) {
			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getNewLine(),
			];
		} else {
			$tokens[] = [
				T_WHITESPACE,
				' ',
			];
		}

		$tokens = '{';

		$tokens[] = [
			T_WHITESPACE,
			$codingStyle->getNewLine(),
		];

		return $tokens;
	}
}
