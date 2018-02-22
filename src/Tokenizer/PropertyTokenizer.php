<?php

namespace Kanel\Enuma\Tokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\ValuePrinter;
use Kanel\Enuma\Hint\VisibilityHint;
use Kanel\Enuma\Sections;

class PropertyTokenizer implements Tokenizable
{
	use ValuePrinter;

    public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
    {
        $properties = $sections->getSection(Sections::PROPERTIES_SECTION);
		if (!$properties) {
			return [];
		}

		$tokens = [];

		foreach ($properties as $property) {
			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getIndentation(),
			];

			if ($property->getVisibility()) {
				switch ($property->getVisibility()) {
					case VisibilityHint::PRIVATE:
						$tokens[] = [
							T_PRIVATE,
							'private',
						];
						break;
					case VisibilityHint::PROTECTED:
						$tokens[] = [
							T_PROTECTED,
							'protected',
						];
						break;
					case VisibilityHint::PUBLIC:
						$tokens[] = [
							T_PUBLIC,
							'public',
						];
						break;
				}

				$tokens[] = [
					T_WHITESPACE,
					' ',
				];
			}
			
			$tokens[] = [
				'$' . $property->getName()
			];

			if ($property->getValue()) {

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
					self::printValue($property->getValue())
				];
			}

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