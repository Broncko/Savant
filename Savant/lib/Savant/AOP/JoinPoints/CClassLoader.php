<?php
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

class CClassLoader extends AJoinPoint
{
    public $NAME = 'LoadClass';

    public $class = null;

    public $loader = null;

    public $file = null;

    public function __construct($pClass, $pLoader = null, $pFile = null)
    {
        parent::__construct();
        $this->class = $pClass;
        $this->loader = $pLoader;
        $this->file = $pFile;
    }
}