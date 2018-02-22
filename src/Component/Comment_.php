<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Value;
use Kanel\Enuma\Component\Definition\Valuable;

class Comment_ extends Component implements Valuable
{
	use Value;

	public function __construct(string $value)
	{
		$this->setValue($value);
	}
}