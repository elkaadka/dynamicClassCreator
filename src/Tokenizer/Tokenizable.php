<?php

namespace Kanel\Enuma\Tokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Sections;

interface Tokenizable
{
	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array;
}