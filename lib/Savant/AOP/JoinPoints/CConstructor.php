<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage JoinPoints
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

/**
 * @package AOP
 * @subpackage JoinPoints
 * constructor joinpoint
 */
class CConstructor extends AJoinPoint
{
    /**
     * label
     * @var string
     */
    public $LABEL = 'construct';

    /**
     * name
     * @var string
     */
    public $NAME = 'Constructor';

    /**
     * create joinpoint instance
     * @param string $pClass
     */
    public function __construct($pClass)
    {
        parent::__construct($pClass);
    }
}