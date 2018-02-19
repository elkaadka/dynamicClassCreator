<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

class UsePrinter implements Printable
{
	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		$useSection = $sections->getSection(Sections::USE_SECTION);
		if (!$useSection) {
			return '';
		}

		$useSection = array_unique($useSection);
		return array_reduce(
			$useSection,
			function($carry, $section) use ($codingStyle) {
				$carry .= 'use ' . $section . ';' . $codingStyle->getNewLine();
				return $carry;
			},
			''
		)
		. $codingStyle->getNewLine();
	}
}