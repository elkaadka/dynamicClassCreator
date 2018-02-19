<?php

namespace Kanel\Enuma;

class Sections
{
	const NAMESPACE_SECTION = 'namespace';
	const USE_SECTION = 'use';
	const CLASS_COMMENT_SECTION = 'classComment';
	const CLASS_FINAL_ABSTRACT_SECTION = 'classFinalAbstract';
	const CLASS_TYPE_SECTION = 'classType';
	const CLASS_NAME = 'className';
	const CLASS_EXTENDS_SECTION = 'extends';
	const CLASS_IMPLEMENTED_CLASSES_SECTION = 'implementedClasses';
	const TRAIT_SECTION = 'trait';
	const CONST_SECTION = 'const';
	const PROPERTIES_SECTION = 'property';
	const METHODS_SECTION = 'function';
	const CLASS_END_SECTION = 'classEnd';
	const LINE_FEED = 'lineFeed';
	const PHP_CLOSE_TAG_SECTION0 = 'closingTag';

	protected $sections;

	public function __construct()
	{
		$this->sections = [
			self::NAMESPACE_SECTION => '',
			self::USE_SECTION => [],
			self::CLASS_COMMENT_SECTION => '',
			self::CLASS_FINAL_ABSTRACT_SECTION => '',
			self::CLASS_TYPE_SECTION => '',
			self::CLASS_NAME => '',
			self::CLASS_EXTENDS_SECTION => '',
			self::CLASS_IMPLEMENTED_CLASSES_SECTION => [],
			self::TRAIT_SECTION => [],
			self::CONST_SECTION => [],
			self::PROPERTIES_SECTION => [],
			self::METHODS_SECTION => [],
			self::CLASS_END_SECTION => '}',
			self::LINE_FEED => '',
			self::PHP_CLOSE_TAG_SECTION0 => '?>',
		];
	}

	/**
	 * @return array
	 */
	public function getSections(): array
	{
		return $this->sections;
	}

	/**
	 * @param string $sectionName
	 * @return mixed|null
	 */
	public function getSection(string $sectionName)
	{
		return $this->sections[$sectionName] ?? null;
	}

	/**
	 * @param array $sections
	 */
	public function setSections(array $sections)
	{
		$this->sections = $sections;
	}

	public function addSection(string $section, $value)
	{
		if ($this->isValid($section)) {
			switch ($this->getType($section)) {
				case 'array': $this->sections[$section][] = $value;
					break;
				default: $this->sections[$section] = $value;
			}

		}
	}

	protected function isValid(string $section): bool
	{
		return array_key_exists($section, $this->sections);
	}

	protected function getType(string $section): string
	{
		if (
			in_array(
				$section,
				[
					self::USE_SECTION,
					self::CLASS_IMPLEMENTED_CLASSES_SECTION,
					self::TRAIT_SECTION,
					self::CONST_SECTION,
					self::PROPERTIES_SECTION,
					self::METHODS_SECTION,
				]
			)
		) {
			return 'array';
		}

		return 'string';
	}

}