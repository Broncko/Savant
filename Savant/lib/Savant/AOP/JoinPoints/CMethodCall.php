<?php
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

class CMethodCall extends AJoinPoint
{
    public $NAME = 'call';

    public $METHOD = '';

    public $ARGS = array();

    public function __construct($pClass, $pMethod, $pArgs = array())
    {
        parent::__construct($pClass);
        $this->METHOD = $pMethod;
        $this->ARGS = $pArgs;
    }
}
