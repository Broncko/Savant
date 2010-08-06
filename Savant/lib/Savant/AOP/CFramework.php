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
class CFramework
{
        /**
         * list of aspects
         * @var array
         */
        private $aspects = array();

        /**
         * pointcut store
         * @var SplObjectStore
         */
        private $pointcuts = null;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
                $this->pointcuts = new \SplObjectStorage();
	}

        /**
         * register aop aspect of type Savant\AOP\AAspect
         * @param AAspect $aspect
         */
        public function registerAspect($pAspect)
        {
            $this->registerPointCut(new CPointcut($pAspect));
        }

        /**
         * register aop pointcut
         * @param CPointcut $pPointcut
         */
        public function registerPointCut(CPointcut $pPointcut)
        {
            $this->pointcuts->attach($pPointcut);
        }

        /**
         * weave in a joinpoint
         * invokes all interceptors whose pointcuts match the given joinpoint
         * @param object $pObj calling object
         * @param AJoinPoint $pJoinPoint joinpoint object
         */
        public static function weaveIn($pObj, AJoinPoint $pJoinPoint)
        {
            foreach($this->pointcuts as $pointcut)
            {
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
            $pointcut = $pJoinPoint->stack->pop();
            while($pJoinPoint->stack->count() !== 0)
            {
                forward_static_call(array((string)$pointcut->aspectClass, 'advice'),$pObj,$pJoinPoint);
                $pointcut = $pJoinPoint->stack->pop();
            }
        }

        /**
         * convenience method to weave in and weave out a joinpoint
         * @param object $pObj
         * @param AJoinPoint $pJoinPoint
         */
        public function weave($pObj, AJoinPoint $pJoinPoint)
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