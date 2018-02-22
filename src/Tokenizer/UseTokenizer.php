<?php

namespace Kanel\Enuma\Tokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

class UseTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$uses = $sections->getSection(Sections::USE_SECTION);
		if (empty($uses)) {
			return [];
		}

		$uses = array_unique($uses);
		$tokens = [];

		foreach ($uses as $use) {
			$tokens[] = [
				T_USE,
				'use',
			];

			$tokens[] = [
				T_WHITESPACE,
				' ',
			];

			foreach (explode('\\', $use) as $tString) {
				$tokens[] = [
					T_STRING,
					$tString,
				];

				$tokens[] = [
					T_NS_SEPARATOR,
					'\\',
				];
			}

			//remove the last \ added (a namespace ends with a class name)
			array_pop($tokens);

			$tokens[] = ';';

			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getNewLine(),
			];

			return $tokens;
		}
	}
}

