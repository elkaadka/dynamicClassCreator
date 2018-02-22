<?php

namespace Kanel\Enuma\Component;

use Kanel\Enuma\Component\Atoms\Name;
use Kanel\Enuma\Component\Definition\Nameable;

class Interface_ extends Component implements Nameable
{
	use Name;

	public function __construct(string $name)
	{
		$this->setName($name);
	}
}