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
 * destructor joinpoint
 */
class CDestructor extends AJoinPoint
{
    /**
     * label
     * @var string
     */
    public $LABEL = 'destruct';

    /**
     * name
     * @var string
     */
    public $NAME = 'Destructor';

    /**
     * create joinpoint instance
     * @param string $pClass
     */
    public function __construct($pClass)
    {
        parent::__construct($pClass);
    }
}