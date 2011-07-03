<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils;

use \Savant\AOP;

class EBenchmark extends \Savant\EException {}

class CBenchmark extends \Savant\AStandardObject implements \Savant\IConfigure
{
    public function __construct()
    {

    }

    public function display()
    {
        
    }

    public static function advice($pObj = null, AOP\CJoinPoint $pJoinPoint)
    {
        $timer = new Benchmark\CTimer();
        switch ($pJoinPoint->DIRECTION)
        {
            case AOP\CJoinPoint::DIRECTION_IN:
                $timer->start();
                break;
            case AOP\CJoinPoint::DIRECTION_OUT:
                $timer->stop();
                breaK;
            default:
                break;
        }
    }
}