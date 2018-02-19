<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Sections;

class ClassEndPrinter implements Printable
{
	use CommentGeneration;

	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		$classSection = $sections->getSection(Sections::CLASS_NAME);
		if (!$classSection) {
			return '';
		}

		return $codingStyle->getNewLine()
			. '}'
			. $codingStyle->getNewLine();

	}
}