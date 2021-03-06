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
namespace Savant\AOP;

/**
 * @package    Savant
 * @subpackage AOP
 * defines aspect interface
 */
interface IAspect
{
    /**
     * @static advice
     * @param object $pObj any object
     * @param \Savant\AOP\CJoinPoint $pJoinPoint joinpoint
     */
    public static function advice($pObj = null, AJoinPoint $pJoinPoint);

    /**
     * @static getJoinPointMask
     * @return array
     */
    public static function getJoinPointMask();
}