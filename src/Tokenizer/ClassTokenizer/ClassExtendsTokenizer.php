<?php

namespace Kanel\Enuma\Tokenizer\ClassTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class ClassExtendsTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$extends = $sections->getSection(Sections::CLASS_EXTENDS_SECTION);
		if (!$extends) {
			return [];
		}

		$tokens = [];

		$tokens[] = [
			T_WHITESPACE,
			' '
		];

		$tokens[] = [
			T_EXTENDS,
			'extends'
		];

		$tokens[] = [
			T_WHITESPACE,
			' '
		];

		$tokens[] = [
			T_STRING,
			$extends
		];

		return $tokens;
	}
}
