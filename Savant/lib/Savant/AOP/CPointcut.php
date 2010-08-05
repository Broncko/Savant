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
 * Exception-handling for pointcuts
 *
 */
class EPointcut extends \Savant\EException { }

/**
 * @package    Savant
 * @subpackage AOP
 * A Pointcut matches the joinpoints with the aspects and invokes the advice methods
 */
class CPointcut extends \Savant\AStandardObject
{
	/**
	 * pointcutmask
	 * @var array
	 */
	private $pointCutMask = array();

        /**
         * aspect class
         * @var string
         */
        private $aspectClass = '';
	
	/**
	 * Constructor
	 * @param array $pPointCutMask
	 */
	public function __construct($pAspect, $pPointCutMask = array())
	{
            $this->aspectClass = $pAspect;
            $this->pointCutMask = $pPointCutMask;
	}
	
	/**
	 * adds pointcut to pointcutmask
	 * @param string $pPointCut pointcut
	 */
	public function addPointCutToMask($pPointCut = '')
	{
		array_push($this->pointCutMask,$pPointCut);
	}
	
	/**
	 * weaves in or weaves out an aspect at a given joinpoint and invokes the advice method
	 * @param object $pObject any object
	 * @param \Savant\AOP\CJoinPoint $pJoinPoint joinpoint
	 */
	public function weave($pObj = null, CJoinPoint $pJoinPoint)
	{
		foreach($this->pointCutMask as $aspect)
		{
			forward_static_call(array((string)$aspect->class, (string)$aspect->method),$pObj,$pJoinPoint);	
		}
	}
	
}