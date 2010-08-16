<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Aspects
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\CConfigure;

/**
 * @package AOP
 * @subpackage Aspects
 * provides aspect decorator of configuration
 */
class AConfigure extends AOP\AAspect implements AOP\IAspect
{
    /**
     * return list of joinpoints
     * @return array
     */
    public static function getJoinPointMask()
    {
        return array('Savant\AOP\JoinPoints\CClassLoader', 'Savant\AOP\JoinPoints\CConstructor');
    }

    /**
     * provides aspect functionality
     * @param object $pObj object to configure
     * @param AOP\AJoinPoint $pJoinPoint joinpoint
     */
    public static function advice($pObj, AOP\AJoinPoint $pJoinPoint)
    {
        switch($pJoinPoint)
        {
            case $pJoinPoint instanceof AOP\JoinPoints\CConstructor:
                if($pJoinPoint->DIRECTION == AOP\AJoinPoint::DIRECTION_IN)
                {
                    self::onBeforeConstructor($pObj, $pJoinPoint);
                }
                break;
            case $pJoinPoint instanceof AOP\JoinPoints\CClassLoader:
                if($pJoinPoint->DIRECTION == AOP\AJoinPoint::DIRECTION_OUT)
                {
                    self::onAfterLoadClass($pObj, $pJoinPoint);
                }
                break;
        }
    }

    /**
     * invoke before constructor is called
     * @param IConfigure $pObj
     * @param AOP\AJoinPoint $pJoinPoint
     */
    public static function onBeforeConstructor(&$pObj, AOP\AJoinPoint $pJoinPoint)
    {
        if(!($pObj instanceof \Savant\IConfigure))
        {
            return;
        }

        $class = \get_class($pObj);
        try
        {
            $config = CConfigure::getClassConfig($class);
        }
        catch(\Savant\EConfigure $e)
        {
            \Savant\CBootstrap::log($e->getMessage());
            return;
        }
        foreach($config as $confProp => $confVal)
        {
            try
            {
                $propObj = new \ReflectionProperty($class, \strtoupper($confProp));
                $propObj->setValue($pObj, $confVal);
            }
            catch(ReflectionException $e)
            {

            }
        }
    }

    /**
     * invoke after classloader is called
     * @param IConfigure $pObj
     * @param AOP\AJoinPoint $pJoinPoint
     */
    public static function onAfterLoadClass(&$pObj, AOP\AJoinPoint $pJoinPoint)
    {

    }
}