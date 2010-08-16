<?php
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

class CConstructor extends AJoinPoint
{
    public $LABEL = 'construct';

    public $NAME = 'Constructor';

    public function __construct($pClass)
    {
        parent::__construct($pClass);
    }
}