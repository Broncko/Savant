<?php
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

class CClassLoader extends AJoinPoint
{
    public $LABEL = 'load class';

    public $NAME = 'Classloader';

    public $loader = null;

    public $file = null;

    public function __construct($pClass, $pLoader = null, $pFile = null)
    {
        parent::__construct($pClass);
        $this->loader = $pLoader;
        $this->file = $pFile;
    }
}