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
        public $CLASS = '';
	
	/**
	 * @var string
	 */
	public $DIRECTION = self::DIRECTION_IN;
	
	/**
	 * stores result from invoked method
	 * @var mixed
	 */
	public $result = '';

        /**
         * stores pointcuts
         * @var SplStack
         */
        public $stack = null;
	
	/**
	 * Constructor
         * @param string $pClass
	 * @param string $pDirection
	 */
	public function __construct($pClass, $pDirection = self::DIRECTION_IN)
	{
            $this->CLASS = $pClass;
            $this->DIRECTION = $pDirection;
            $this->stack = new \SplStack();
	}

        public function __get($pKey)
        {
            return null;
        }
}