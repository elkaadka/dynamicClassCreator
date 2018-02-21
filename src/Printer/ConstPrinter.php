<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Helper\ValuePrinter;
use Kanel\Enuma\Sections;

class ConstPrinter implements Printable
{
	use CommentGeneration;
	use ValuePrinter;

	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		$constSection = $sections->getSection(Sections::CONST_SECTION);

		if (!$constSection) {
			return '';
		}

		$_ = '';
		foreach ($constSection as $const) {
			$_ .= $codingStyle->getIndentation()
				. ($const->getVisibility()? $const->getVisibility() . ' ' : '')
				. 'const ' . $const->getName()
				. ' = ' . self::printValue($const->getValue())
				. ';'
				. $codingStyle->getNewLine()
			;
		}

		return $_ . $codingStyle->getNewLine();
	}
}