<?php
namespace Savant\AOP\JoinPoints;

class CDestructor extends \Savant\AOP\AJoinPoint
{
    public $LABEL = 'destruct';

    public $NAME = 'Destructor';

    public function __construct($pClass)
    {
        parent::__construct($pClass);
    }
}