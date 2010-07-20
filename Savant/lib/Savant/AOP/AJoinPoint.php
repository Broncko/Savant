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

use \Savant;

/**
 * @package    Savant
 * @subpackage AOP
 * Exception-handling for joinpoints
 *
 */
class EJoinPoint extends Savant\EException {}

/**
 * @package    Savant
 * @subpackage AOP
 * Value object to store joinpoint informations
 */
abstract class AJoinPoint
{	
	/**
	 * call direction in
	 * @var string
	 */
	const DIRECTION_IN = '-->';
	
	/**
	 * call direction out
	 * @var string
	 */
	const DIRECTION_OUT = '<--';
	
	/**
	 * @var string
	 */
	public $NAME = '';
	
	/**
	 * @var string
	 */
	public $DIRECTION = self::DIRECTION_IN;

        /**
         * @var SplStack
         */
        public $STACK = null;
	
	/**
	 * stores result from invoked method
	 * @var mixed
	 */
	public $result = '';
	
	/**
	 * Constructor
	 * @param string $pName
	 * @param string $pClassName
	 * @param string $pMethodName
	 * @param array $pMethodArgs
	 * @param string $pDirection
	 */
	public function __construct($pDirection = self::DIRECTION_IN)
	{
		$this->DIRECTION = $pDirection;
                $this->STACK = new \SplStack();
	}
}