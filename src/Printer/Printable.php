<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

interface Printable
{
	public static function print(Sections $sections, CodingStyle $codingStyle): string;
}