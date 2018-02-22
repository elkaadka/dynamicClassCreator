<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Value;
use Kanel\Enuma\Component\Definition\Valuable;

class Namespace_ extends Component implements Valuable
{
	use Value;

	public function __construct(string $namespace)
	{
		$this->setValue($namespace);
	}
}