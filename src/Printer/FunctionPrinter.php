<?php

namespace Kanel\Enuma\Printer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Component\Parameter;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Helper\ValuePrinter;
use Kanel\Enuma\Sections;

class FunctionPrinter implements Printable
{
	use CommentGeneration;
	use ValuePrinter;

	public static function print(Sections $sections, CodingStyle $codingStyle): string
	{
		$functions = $sections->getSection(Sections::METHODS_SECTION);

		if (!$functions) {
			return '';
		}

		$_ = $codingStyle->getNewLine();

		foreach ($functions as $function) {

			$_ .= rtrim(
				$codingStyle->getNewLine()
				. self::generateDocComment(
					$function->getComment(),
					$codingStyle->getIndentation(),
					$codingStyle->getNewLine()
				)
				. $codingStyle->getIndentation()
				. ($function->isAbstract() ? 'abstract ' : '')
				. ($function->isFinal() ? 'final ' : '')
				. ($function->getVisibility() ? $function->getVisibility()  . ' ' : '')
				. ($function->isStatic() ? 'static ' : '')
				. 'function '
				. $function->getName()
				. '('
				. rtrim(
					array_reduce(
						$function->getParameters(),
						function ($carry, Parameter $parameter) {
							$carry .= ($parameter->getType()? $parameter->getType() . ' ' : '')
								. '$' . $parameter->getName()
								. ($parameter->getValue()? ' = ' . self::printValue($parameter->getValue(), $parameter->getType()) : '')
								. ', ';

							return $carry;
						}
					)
					, ', ')
				. ')'
				. ($function->getType()? ': ' . $function->getType() : '')
				. (
				($sections->getSection(Sections::CLASS_TYPE_SECTION) === 'interface' || $function->isAbstract()) ? ';' :
					($codingStyle->isMethodBracesInNewLine()? $codingStyle->getNewLine() : '')
					. $codingStyle->getIndentation()
					. '{'
					. $codingStyle->getNewLine()
					. $codingStyle->getNewLine()
					. $codingStyle->getIndentation()
					. '}'
				)
			) . $codingStyle->getNewLine();;
		}

		return $_;
	}
}