<?php

namespace Kanel\Enuma\Tokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

class NamespaceTokenizer implements Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$namespace = $sections->getSection(Sections::NAMESPACE_SECTION);
		if (!$namespace) {
			return [];
		}

		$tokens[] = [
			T_NAMESPACE,
			'namespace',
		];

		$tokens[] = [
			T_WHITESPACE,
			' ',
		];

		foreach (explode('\\', $namespace) as $tString) {

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