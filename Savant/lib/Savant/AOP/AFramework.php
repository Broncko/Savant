<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage AOP
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\AOP;

/**
 * @package    Savant
 * @subpackage AOP
 * Exception-handling for AOP Framework
 *
 */
class EFramework extends \Savant\EException {}

/**
 * @package    Savant$value
 * @subpackage AOP
 * provides global information for objects which use aop functionality
 */
abstract class AFramework
{
    /**
     * pointcut array
     * @var array
     */
    public static $pointcuts = array();

    /**
     * register aop aspect of type Savant\AOP\AAspect
     * @param AAspect $aspect
     */
    public static function registerAspect($pAspect)
    {
        $joinPointMask = \forward_static_call(array($pAspect, 'getJoinPointMask'));
        self::registerPointCut(new CPointcut($pAspect, $joinPointMask));
    }

    /**
     * register aop pointcut
     * @param CPointcut $pPointcut
     */
    public static function registerPointCut(CPointcut $pPointcut)
    {
        self::$pointcuts[] = $pPointcut;
    }

    public static function registerAspects($pAspects = array())
    {
        if(count($pAspects) == 0)
        {
            $pAspects = self::getAspectsFromFolder();
        }
        foreach($pAspects as $aspect)
        {
            self::registerAspect($aspect);
        }
    }

    public static function getAspectsFromFolder()
    {
        $dirIter = new \FilesystemIterator(\Savant\CBootstrap::$ASPECT_DIR, \FilesystemIterator::SKIP_DOTS);
        foreach ($dirIter as $aspectFile) {
            $aspect = \str_replace('.php', '', $aspectFile);
            $aspect = \str_replace(\Savant\CBootstrap::$FRAMEWORK_DIR, '', $aspect);
            $aspects[] = 'Savant'.\str_replace(\DIRECTORY_SEPARATOR, '\\', $aspect);
        }
        return $aspects;
    }

    /**
     * TODO: merge with getAspectsFromFolder
     * @return array
     */
    public static function getJoinPointsFromFolder()
    {
        $dirIter = new \FilesystemIterator(\Savant\CBootstrap::$JOINPOINT_DIR, \FilesystemIterator::SKIP_DOTS);
        foreach ($dirIter as $aspectFile) {
            $aspect = \str_replace('.php', '', $aspectFile);
            $aspect = \str_replace(\Savant\CBootstrap::$FRAMEWORK_DIR, '', $aspect);
            $aspects[] = 'Savant'.\str_replace(\DIRECTORY_SEPARATOR, '\\', $aspect);
        }
        return $aspects;
    }
    
    /**
     * weave in a joinpoint
     * invokes all interceptors whose pointcuts match the given joinpoint
     * @param object $pObj calling object
     * @param AJoinPoint $pJoinPoint joinpoint object
     */
    public static function weaveIn($pObj, AJoinPoint $pJoinPoint)
    {
        foreach(self::$pointcuts as $pointcut)
        {
            if(!\in_array(\get_class($pJoinPoint), (array)$pointcut->joinPointMask))
            {
                continue;
            }
            if(\property_exists($pointcut->aspectClass, 'BASE_CLASS'))
            {
                $rf = new \ReflectionProperty($pointcut->aspectClass, 'BASE_CLASS');
                if($rf->getValue() == $pJoinPoint->CLASS)
                {
                    continue;
                }
            }
            $pJoinPoint->stack->push($pointcut);
            forward_static_call(array((string)$pointcut->aspectClass, 'advice'),$pObj,$pJoinPoint);
        }
    }

    /**
     * weave out a joinpoint
     * invokes all interceptors stored in joinPointStack
     * @param object $pObj calling object
     * @param AJoinPoint $pJoinPoint joinpoint object
     */
    public static function weaveOut($pObj, AJoinPoint $pJoinPoint)
    {
        $pJoinPoint->DIRECTION = AJoinPoint::DIRECTION_OUT;
        while($pJoinPoint->stack->count() != 0)
        {
            $pointcut = $pJoinPoint->stack->pop();
            forward_static_call(array((string)$pointcut->aspectClass, 'advice'),$pObj,$pJoinPoint);
        }
    }

    /**
     * convenience method to weave in and weave out a joinpoint
     * @param object $pObj
     * @param AJoinPoint $pJoinPoint
     */
    public static function weave($pObj, AJoinPoint $pJoinPoint)
    {
        try
        {
            self::weaveIn($pObj, $pJoinPoint);
            self::weaveOut($pObj, $pJoinPoint);
        }
        catch(\Savant\EFramework $e)
        {
            //silently stop call stack execution
        }
    }
}