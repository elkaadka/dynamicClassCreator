<?php

namespace Kanel\Enuma\Tokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Helper\ValuePrinter;
use Kanel\Enuma\Sections;

class ConstTokenizer implements Tokenizable
{
	use CommentGeneration;
	use ValuePrinter;

	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$consts = $sections->getSection(Sections::TRAIT_SECTION);
		if (!$consts) {
			return [];
		}

		$tokens = [];

		foreach ($consts as $const) {
			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getIndentation(),
			];

			$tokens[] = [
				T_CONST,
				'const'
			];

			$tokens[] = [
				T_WHITESPACE,
				' ',
			];

			$tokens[] = [
				T_STRING,
				$const->getName(),
			];

			$tokens[] = [
				T_WHITESPACE,
				' ',
			];

			$tokens[] = '=';

			$tokens[] = [
				T_WHITESPACE,
				' ',
			];

			$tokens[] = [
				T_CONSTANT_ENCAPSED_STRING,
				self::printValue($const->getValue())
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