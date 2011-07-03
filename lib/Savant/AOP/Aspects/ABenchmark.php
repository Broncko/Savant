<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

/**
 * @namespace Savant\AOP\Aspects
 */
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\Utils\Benchmark\CProfiler;

/**
 * provides aspect decorator of benchmarkclass
 */
abstract class ABenchmark extends AOP\AAspect implements AOP\IAspect
{
    /**
     * return list of joinpoints
     * @return array
     */
    public static function getJoinPointMask()
    {
        return array();
    }

    /**
     * provides aspect functionality
     * @param object $pObj
     * @param AOP\AJoinPoint $pJoinPoint
     */
    public static function advice($pObj, AOP\AJoinPoint $pJoinPoint)
    {
        if(!\Savant\CBootstrap::$BENCHMARK)
        {
            return;
        }
        if(!$pJoinPoint instanceof AOP\JoinPoints\CMethodCall)
        {
            return;
        }
        $profiler = new CProfiler();
        switch($pJoinPoint->DIRECTION)
        {
            case AOP\AJoinPoint::DIRECTION_IN:
                $profiler->enterSection($pJoinPoint->METHOD);
                break;
            case AOP\AJoinPoint::DIRECTION_OUT:
                $profiler->leaveSection($pJoinPoint->METHOD);
                break;
        }
    }
}