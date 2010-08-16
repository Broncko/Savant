<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils;

use \Savant\AOP;

/**
 * @package Savant
 * @package Utils
 * Exception-handling for logging
 *
 */
class ELogging extends \Savant\EException { }

/**
 * @package Savant
 * @subpackage Utils
 * abstract logging class 
 * 
 */
abstract class ALogging extends AOP\AAspect implements \Savant\IConfigure, AOP\IAspect
{
	/**
	 * level debug
	 * @var string
	 */
	const LEVEL_DEBUG = 'debug';
	
	/**
	 * level info
	 * @var string
	 */
	const LEVEL_INFO = 'info';
	
	/**
	 * level warning
	 * @var string
	 */
	const LEVEL_WARNING = 'warning';
	
	/**
	 * level error
	 * @var string
	 */
	const LEVEL_ERROR = 'error';
	
	/**
	 * level critical
	 * @var string
	 */
	const LEVEL_CRITICAL = 'critical';
	
	/**
	 * logtemplate
	 * @var string
	 */
	public $LOGTEMPLATE = null;
	
	/**
	 * Constructor
	 * @param string $pSection section of configuration file
	 */
	public function __construct($pSection = 'default')
	{
		parent::__construct($pSection);
	}
}
