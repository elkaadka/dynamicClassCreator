<?php

namespace Kanel\Enuma\Tokenizer\ClassTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class ClassFinalTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$classSection = $sections->getSection(Sections::CLASS_NAME);
		if (!$classSection) {
			return [];
		}

		$tokens = [];

		if ($sections->getSection(Sections::CLASS_FINAL_ABSTRACT_SECTION) === 'final') {
			$tokens[] = [
				T_FINAL,
				'final',
			];

			$tokens[] = [
				T_WHITESPACE,
				' ',
			];
		}

		return $tokens;
	}
}
