<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

class StartTagPrinter implements Printable
{

	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		return '<?php'
			. $codingStyle->getNewLine()
			. $codingStyle->getNewLine();
	}
}