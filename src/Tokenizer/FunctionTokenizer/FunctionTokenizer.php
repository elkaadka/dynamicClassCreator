<?php

namespace Kanel\Enuma\Tokenizer\FunctionTokenizer;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Component\Parameter;
use Kanel\Enuma\Helper\CommentGeneration;
use Kanel\Enuma\Helper\ValuePrinter;
use Kanel\Enuma\Sections;
use Kanel\Enuma\Tokenizer\Tokenizable;

class FunctionTokenizer implements Tokenizable
{
	use CommentGeneration;
	use ValuePrinter;

	public static function getTokens(Sections $sections, CodingStyle $codingStyle): array
	{
		$functions = $sections->getSection(Sections::METHODS_SECTION);
		if (!$functions) {
			return [];
		}

		$tokenizers = [
			new FunctionCommentTokenizer(),
		];

		$tokens = [];

		foreach ($tokenizers as $tokenizer) {
			$tokens = array_merge($tokens, $tokenizer->getTokens($sections, $codingStyle));
		}

		return $tokens;

		$functions = $sections->getSection(Sections::METHODS_SECTION);

		if (!$functions) {
			return [];
		}

		$tokens = [];

		foreach ($functions as $function) {

			$tokens[] = [
				T_WHITESPACE,
				$codingStyle->getIndentation(),
			];


			$_ .=
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
			)
				. $codingStyle->getNewLine()
				. $codingStyle->getNewLine();
			;
		}

		return rtrim($_, $codingStyle->getNewLine()) . $codingStyle->getNewLine() ;
	}
}