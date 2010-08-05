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
	 * stack to store joinpoints
	 * @var SplStack
	 */
	private $joinPointStack = null;

        /**
         * list of aspects
         * @var array
         */
        private $aspects = array();

        /**
         * stack to store pointcuts
         * @var SplStack
         */
        private $PointcutStack = null;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->joinPointStack = new \SplStack();
	}

	/**
	 * Adds joinpoint to stack
	 * @param \Savant\AOP\AJoinPoint $pJoinPoint joinpoint
	 */
	public function addJoinPoint(AJoinPoint $pJoinPoint)
	{
		$this->joinPointStack->push($pJoinPoint);
	}
	
	/**
	 * Removes joinpoint from stack
	 * @param \Savant\AOP\AJoinPoint $pJoinPoint joinpoint
	 */
	public function removeJoinPoint(AJoinPoint $pJoinPoint)
	{
		$this->joinPointStack->pop();
	}
	
	/**
	 * Returns all joinpoints
	 * @return SplStack
	 */
	public function getJoinPoints()
	{
		return $this->joinPointStack;
	}

        /**
         * Returns last joinpoint from stack
         * @return \Savant\AOP\AJoinPoint $pJoinPoint joinpoint
         */
        public function getLastJoinPoint()
        {
            return $this->joinPointStack->pop();
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
            $this->PointcutStack->push($pPointcut);
        }
}