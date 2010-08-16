<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    JoinPoints
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

/**
 * @package JoinPoints
 * methodcall joinpoint
 */
class CMethodCall extends AJoinPoint
{
    /**
     * label
     * @var string
     */
    public $LABEL = 'call';

    /**
     * name
     * @var string
     */
    public $NAME = 'Method Call';

    /**
     * method
     * @var string
     */
    public $METHOD = '';

    /**
     * arguments
     * @var array
     */
    public $ARGS = array();

    /**
     * create joinpoint instance
     * @param string $pClass
     * @param string $pMethod
     * @param array $pArgs
     */
    public function __construct($pClass, $pMethod, $pArgs = array())
    {
        parent::__construct($pClass);
        $this->METHOD = $pMethod;
        $this->ARGS = $pArgs;
    }
}
