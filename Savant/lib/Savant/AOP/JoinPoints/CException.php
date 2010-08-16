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
 * exception joinpoint
 */
class CException extends AJoinPoint
{
    /**
     * label
     * @var string
     */
    public $LABEL = 'exception';

    /**
     * name
     * @var string
     */
    public $NAME = 'Exception';

    /**
     * exception object
     * @var Savant\EException
     */
    public $e = null;

    /**
     * exception handler
     * @var object
     */
    public $handler = null;

    /**
     * create joinpoint instance
     * @param Savant\EException $pE
     * @param object $pHandler
     */
    public function __construct($pE = null, $pHandler = null)
    {
        parent::__construct();
        $this->e = $pE;
        $this->handler = $pHandler;
    }
}
