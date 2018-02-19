<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

class TraitPrinter implements Printable
{
	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		$_ = '';

		$traitSection = $sections->getSection(Sections::TRAIT_SECTION);
		if ($traitSection) {
			$_ = $codingStyle->getNewLine();
			foreach ($traitSection as $trait) {
				$_ .= $codingStyle->getIndentation() . 'use ' . $trait . ';' . $codingStyle->getNewLine();
			}
		}

		return $_;
	}
}