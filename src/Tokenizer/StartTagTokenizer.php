<?php

namespace Kanel\Enuma\Tokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Token\Token;

class StartTagTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$tokens  = [];

		$tokens[] = [
			T_OPEN_TAG,
			'<?php',
		];

		$tokens[] = [
			T_WHITESPACE,
			$codingStyle->getNewLine(),
		];

		return $tokens;
	}
}