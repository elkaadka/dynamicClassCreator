<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

class NamespacePrinter implements Printable
{
	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		$namespaceSection = $sections->getSection(Sections::NAMESPACE_SECTION);
		if ($namespaceSection) {
			return 'namespace '
				. $namespaceSection
				. ';'
				. $codingStyle->getNewLine()
				. $codingStyle->getNewLine();
		}

		return '';
	}
}