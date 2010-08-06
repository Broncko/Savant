<?php
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

class CException extends AJoinPoint
{
    public $NAME = 'Exception';

    public $e = null;

    public $handler = null;

    public function __construct($pE = null, $pHandler = null)
    {
        parent::__construct();
        $this->e = $pE;
        $this->handler = $pHandler;
    }
}
