<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;

/**
 * @package Savant
 * Exception-handling for framework class
 *
 */
class EFramework extends EException {}

/**
 * @package Savant
 * holds information and helper functions for the framework
 */
abstract class AFramework implements IConfigure 
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
	 * log indent
	 * @var string
	 */
	const LOG_INDENT = '    ';
	
	/**
	 * log level
	 * @var string
	 */
	public static $LEVEL = self::LEVEL_DEBUG; 
	
	/**
	 * permanent logging
	 * @var bool
	 */
	public static $PERMANENT_LOG = true;
	
	/**
	 * @static get error code from error level
	 * @param string $pLevel error level
	 * @return integer error code
	 */
	public static function getErrorCode($pLevel = null)
	{
		$errCodeArr = array(
			self::LEVEL_DEBUG => 100,
			self::LEVEL_INFO => 200,
			self::LEVEL_WARNING => 300,
			self::LEVEL_ERROR => 400,
			self::LEVEL_CRITICAL => 500
		);
		
		return $errCodeArr[$pLevel];
	}
	
	/**
	 * @static get error type from error code
	 * @param integer $pCode error code
	 * @return string error level
	 */
	public static function getErrorType($pCode = null)
	{
		$errTypeArr = array(
			100 => self::LEVEL_DEBUG,
			200 => self::LEVEL_INFO,
			300 => self::LEVEL_WARNING,
			400 => self::LEVEL_ERROR,
			500 => self::LEVEL_CRITICAL
		);
		
		return $errTypeArr[$pCode];
	}
	
}