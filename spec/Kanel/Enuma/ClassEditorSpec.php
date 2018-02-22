<?php

namespace spec\Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\CodingStyle\CustomCodingStyle;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class ClassEditorSpec extends ObjectBehavior
{
	public function getMatchers(): array {
		return [
			'beAFile' => function($subject, $value, $json_option = 0) {
				if (is_file($subject) && basename($subject) === $value) {
					return true;
				}

				throw new FailureException(
					sprintf(
						'expected %s to be a file',
						$subject
					)
				);
			}
		];
	}

    function it_should_be_instantiated_with_at_least_source_class()
    {
        $this->beConstructedWith(CustomCodingStyle::class);
    }

	function it_should_be_able_to_set_a_custom_coding_style()
	{
		$this->beConstructedWith(CodingStyle::class, new CustomCodingStyle());
		$this->getClassFile()->shouldBeAFile('CodingStyle.php');
		$this->getCodingStyle()->shouldBeAnInstanceOf(CustomCodingStyle::class);
	}

	function it_should()
	{
		$this->beConstructedWith(CodingStyle::class, new CustomCodingStyle());
		$this->toString();
	}
}
