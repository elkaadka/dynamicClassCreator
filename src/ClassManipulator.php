<?php

namespace Kanel\Dynamic;

use Kanel\Dynamic\CodingStyle\CodingStyle;
use Kanel\Dynamic\CodingStyle\Psr2;

class ClassManipulator
{
    protected $codingStyle;

    public function __construct(CodingStyle $codingStyle)
    {
        $this->codingStyle = $codingStyle ?? new Psr2();
    }

    /**
     * @param CodingStyle $codingStyle
     * @return ClassManipulator
     */
    public function setCodingStyle(CodingStyle $codingStyle): ClassManipulator
    {
        $this->codingStyle = $codingStyle;
    }


}


$lcass = new ClassManipulator();
$class->setCodingStyle(new \Kanel\Dynamic\CodingStyle\Psr2());

$class = new ClassComponent('hello');
$class->setNameSpace('Hello');
$class->extends(Myclass::class);
$class->implements([MyInterface::class]);

$class->usesTrait(MyTraitClass::class, 'myT');

$class->create($class);