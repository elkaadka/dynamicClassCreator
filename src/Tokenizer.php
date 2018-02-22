<?php

namespace Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Component\Class_;
use Kanel\Enuma\Tokenizer\ClassTokenizer\{ClassAbstractTokenizer, ClassCommentTokenizer, ClassExtendsTokenizer};
use Kanel\Enuma\Tokenizer\ClassTokenizer\{
	ClassEndTokenizer, ClassFinalTokenizer, ClassImplementsTokenizer, ClassOpenBracesTokenizer, ClassTokenizer
};
use Kanel\Enuma\Tokenizer\ConstTokenizer;
use Kanel\Enuma\Tokenizer\EndTagTokenize;
use Kanel\Enuma\Tokenizer\FunctionTokenizer\FunctionTokenizer;
use Kanel\Enuma\Tokenizer\NamespaceTokenizer;
use Kanel\Enuma\Tokenizer\PropertyTokenizer;
use Kanel\Enuma\Tokenizer\StartTagTokenizer;
use Kanel\Enuma\Tokenizer\TraitTokenizer;
use Kanel\Enuma\Tokenizer\UseTokenizer;

class Tokenizer
{
	protected $class;
	protected $codingStyle;
	protected $tokens;

	public function __construct(Class_ $class, CodingStyle $codingStyle)
	{
		$this->class = $class;
		$this->codingStyle = $codingStyle;
		$this->tokens = [];
	}

	public function tokenGetAll()
	{
		return $this->tokens;
	}

	public function tokenize()
	{
		$tokenizers = [
			new StartTagTokenizer(),
			new NamespaceTokenizer(),
			new UseTokenizer(),
			new ClassCommentTokenizer(),
			new ClassAbstractTokenizer(),
			new ClassFinalTokenizer(),
			new ClassTokenizer(),
			new ClassExtendsTokenizer(),
			new ClassImplementsTokenizer(),
			new ClassOpenBracesTokenizer(),
			new TraitTokenizer(),
			new ConstTokenizer(),
			new PropertyTokenizer(),
			new FunctionTokenizer(),
			new ClassEndTokenizer(),
			new EndTagTokenize()
		];

		foreach ($tokenizers as $tokenizer) {
			$this->tokens = array_merge($this->tokens, $tokenizer->getTokens($this->sections, $this->codingStyle));
		}

		return $this->tokens;
	}
}