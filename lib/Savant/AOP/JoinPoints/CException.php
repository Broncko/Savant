<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

/**
 * @package AOP
 * @subpackage JoinPoints
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
     * message
     * @var string
     */
    public $MESSAGE = '';

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
    public function __construct(\Savant\EException $pE, $pHandler = null)
    {
        parent::__construct(get_class($pE));
        $this->e = $pE;
        $this->MESSAGE = $pE->getMessage();
        $this->handler = $pHandler;
    }
}
