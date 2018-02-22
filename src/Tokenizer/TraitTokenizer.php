<?php

namespace Kanel\Enuma\Tokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

class TraitTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$traits = $sections->getSection(Sections::TRAIT_SECTION);
		if (!$traits) {
			return [];
		}

		$tokens = [];

		foreach ($traits as $trait) {
			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getIndentation(),
			];

			$tokens[] = [
				T_USE,
				'use'
			];

			$tokens[] = [
				T_WHITESPACE,
				' ',
			];

			$tokens[] = [
				T_STRING,
				$trait,
			];

			$tokens[] = ';';

			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getNewLine(),
			];
		}

		$tokens[] = [
			T_WHITESPACE,
			$codingStyle->getNewLine(),
		];

		return $tokens;
	}
}
