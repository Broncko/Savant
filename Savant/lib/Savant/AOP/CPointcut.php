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
	 * joinpointmask
	 * @var array
	 */
	public $joinPointMask = array();

        /**
         * aspect class
         * @var string
         */
        public $aspectClass = '';
	
	/**
	 * Constructor
	 * @param array $pPointCutMask
	 */
	public function __construct($pAspect, $pJoinPointMask = array())
	{
            $this->aspectClass = $pAspect;
            $this->joinPointMask = $pJoinPointMask;
	}
	
	/**
	 * adds pointcut to pointcutmask
	 * @param string $pPointCut pointcut
	 */
	public function addPointCutToMask($pPointCut = '')
	{
		array_push($this->pointCutMask,$pPointCut);
	}
}