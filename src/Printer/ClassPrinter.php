<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Sections;

class ClassPrinter implements Printable
{
	use CommentGeneration;

	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		$classSection = $sections->getSection(Sections::CLASS_NAME);
		if (!$classSection) {
			return '';
		}

		$classComment = self::generateDocComment(
			$sections->getSection(Sections::CLASS_COMMENT_SECTION),
			'',
			$codingStyle->getNewLine()
		);


		$extends = '';
		if ($sections->getSection(Sections::CLASS_EXTENDS_SECTION)) {
			$extends = 'extends ' . $sections->getSection(Sections::CLASS_EXTENDS_SECTION);
		}

		$interfaces = '';
		if ($sections->getSection(Sections::CLASS_IMPLEMENTED_CLASSES_SECTION)) {
			$interfaces = 'implements ' . implode(', ', $sections->getSection(Sections::CLASS_IMPLEMENTED_CLASSES_SECTION));
		}

		return
			$classComment
			. rtrim(
				ltrim($sections->getSection(Sections::CLASS_FINAL_ABSTRACT_SECTION) . ' ')
				. $sections->getSection(Sections::CLASS_TYPE_SECTION)
				. ' '
				. $sections->getSection(Sections::CLASS_NAME)
				. ' '
				. $extends . ($extends ? ' ' : '')
				. $interfaces
			)
			. ($codingStyle->isClassBracesInNewLine()? $codingStyle->getNewLine() : " ")
			. '{'
		;

	}
}