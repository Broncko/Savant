<?php
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

class CMethodCall extends AJoinPoint
{
    public $NAME = 'call';

    public $METHOD = '';

    public $ARGS = array();

    public function __construct($pMethod = '', $pArgs = array())
    {
        parent::AJoinPoint();
        $this->METHOD = $pMethod;
        $this->ARGS = $pArgs;
    }
}
