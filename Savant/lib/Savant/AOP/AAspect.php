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
 * Exception-handling for Aspects
 *
 */
class EAspect extends \Savant\EException {}

/**
 * @package    Savant
 * @subpackage AOP
 * Holds basic informations of aspects 
 */
abstract class AAspect extends \Savant\AStandardObject
{
	/**
	 * Constructor
	 * @param string $pSection section of configuration file
	 */
	public function __construct($pSection = 'default')
	{
		parent::__construct($pSection);
	}
	
}