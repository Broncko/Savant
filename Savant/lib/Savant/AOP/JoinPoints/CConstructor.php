<?php
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

class CConstructor extends AJoinPoint
{
    public $NAME = 'Construct';

    public $class = '';

    public function __construct($pClass)
    {
        parent::__construct();
        $this->class = $pClass;
    }
}