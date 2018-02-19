<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Helper\ValuePrinter;
use Kanel\Enuma\Sections;

class PropertyPrinter implements Printable
{
	use ValuePrinter;

    public static function print(Sections $sections, CodingStyle $codingStyle): string
    {
        $propertySection = $sections->getSection(Sections::PROPERTIES_SECTION);

        if (!$propertySection) {
            return '';
        }

        $_ = '';

        foreach ($propertySection as $property) {
            $_ = $codingStyle->getIndentation()
                . ($property->getVisibility()? $property->getVisibility() . ' ' : '')
                . ($property->isStatic() ? 'static ' : '')
                . '$' . $property->getName()
                . ($property->getValue() ? ' = ' . self::printValue($property->getValue()) : '')
                . ';'
                . $codingStyle->getNewLine()
            ;
        }

        return rtrim($_);
    }
}