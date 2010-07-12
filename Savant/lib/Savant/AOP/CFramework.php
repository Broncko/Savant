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
 * @package    Savant
 * @subpackage AOP
 * provides global information for objects which use aop functionality
 */
class CFramework
{
	/**
	 * stack to store joinpoints
	 * @var SplObjectStorage
	 */
	private $joinPointStack = null;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->joinPointStack = new SplObjectStorage();
	}

	/**
	 * Adds joinpoint to stack
	 * @param \Savant\AOP\CJoinPoint $pJoinPoint joinpoint
	 */
	public function addJoinPoint(CJoinPoint $pJoinPoint)
	{
		$this->joinPointStack->attach($pJoinPoint);
	}
	
	/**
	 * Removes joinpoint from stack
	 * @param \Savant\AOP\CJoinPoint $pJoinPoint joinpoint
	 */
	public function removeJoinPoint(CJoinPoint $pJoinPoint)
	{
		$this->joinPointStack->detach($pJoinPoint);
	}
	
	/**
	 * Returns all joinpoints
	 * @return SplObjectStorage
	 */
	public function getJoinPoints()
	{
		return $this->joinPointStack;
	}
}