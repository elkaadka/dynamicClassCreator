<?php

namespace Kanel\Enuma;

use Kanel\Enuma\CodingStyle\CodingStyle;
use Kanel\Enuma\Exception\EnumaException;

/**
 * Class ClassEditor
 * @package Kanel\Enuma
 */
class ClassEditor extends ClassCreator
{
    protected $classFile;
    protected $codingStyle;
    protected $sections;

    /**
     * ClassEditor constructor.
     * @param string $className
     * @param CodingStyle|null $codingStyle
     * @throws EnumaException
     */
    public function __construct(string $className, CodingStyle $codingStyle = null)
    {
        if (!class_exists($className)) {
            throw new EnumaException("class $className not found");
        }

        $this->classFile = (new \ReflectionClass($className))->getFileName();
        $this->sections = new Sections();
		parent::__construct($codingStyle);
	}


	public function rename(string $newName): ClassEditor
	{
		$this->class($newName);

		return $this;
	}

	public function toString() : string
	{
		$content = file_get_contents($this->classFile);
		print_r( token_get_all($content));exit;
		if ($this->sections->getSection(Sections::CLASS_NAME)) {
			$this->content = preg_replace(
				'/(class\s+)([a-zA-Z0-9_]+\ )([a-zA-Z0-9_\\\\\s]{0,})/',
				'$1'.$this->sections->getSection(Sections::CLASS_NAME).' $3',
				$this->content
			);
		}

	}

	public function __toString()
	{
		return $this->toString();
	}

	public function saveToFile(string $fileName)
	{
		return file_put_contents(
			$fileName,
			$this->toString(),
			'r+'
		);
	}

	public function getClassFile(): string
	{
		return $this->classFile;
	}
}