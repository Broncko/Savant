<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility collection of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

/**
 * TODO: put logtemplate to config and make it more flexible (variables?!)
 * but log must become a static function (how to solve with logtemplate?)
 */

namespace Savant\Utils;

use \Savant\AOP;

/**
 * @package    Savant
 * @subpackage Utils
 * Exception-handling for filelogging
 *
 */
class EFileLogging extends \Savant\EException { }

/**
 * @package    Savant
 * @subpackage Utils
 * Writes Logdata into a file
 * this class is an aspect used by aspect oriented programming. check interface \Savant\AOP\IAspect to get
 * more information
 */
class CFileLogging extends ALogging implements ILogging, AOP\IAspect   
{
	/**
	 * Linebreak
	 * @var string
	 */
	const CR = "\n";
	
	/**
	 * default logging output
	 * @var string
	 */
	const DEFAULT_TPL = "%TIMESTAMP %PID %LEVEL %CONTENT";
	
	/**
	 * indent counter
	 * @var integer
	 */
	public static $INDENT_COUNT = 0;
	
	/**
	 * path to logfile
	 * @var string
	 */
	public $LOGFILE = null;
	
	/**
	 * Constructor
	 * @param string $pLogfile path to logfile
	 */
	public function __construct($pLogfile = null)
	{
		parent::__construct();
		if($pLogfile != null)
		{
			$this->LOGFILE = $pLogfile;
		}
	}
	
	/**
	 * log
	 * @param string $pText content
	 * @param string $pLevel loglevel
	 */
	public function log($pText = '', $pLevel = \Savant\AFramework::LEVEL_DEBUG)
	{
		$indent = (self::$INDENT_COUNT > 0 ? str_repeat(\Savant\AFramework::LOG_INDENT,self::$INDENT_COUNT) : '');
		
		$content = str_replace('%CONTENT',$indent.$pText,$this->LOGTEMPLATE);
		$content = str_replace('%LEVEL',$pLevel,$content);
		$content = str_replace('%TIMESTAMP',date('m/d H:i:s'),$content);
		$content = str_replace('%PID',getmypid(),$content);
		
		file_put_contents($this->LOGFILE, $content.self::CR, FILE_APPEND);
	}
	
	/**
	 * advice to call from pointcut
	 * @static advice
	 * @param object $pObject any object
	 * @param \Savant\AOP\CJoinPoint $pJoinPoint joinpoint
	 */
	public static function advice($pObj = null, AOP\CJoinPoint $pJoinPoint)
	{
		$instance = new self();
		
		switch($pJoinPoint->DIRECTION)
		{
			case AOP\CJoinPoint::DIRECTION_IN:
				$content = sprintf('%senter %s %s->%s(%s)',$indent,$pJoinPoint->NAME,$pJoinPoint->CLASS,$pJoinPoint->METHOD,implode(',',$pJoinPoint->ARGS));
				$instance->log($content);
				self::$INDENT_COUNT += 1;
				break;
			case AOP\CJoinPoint::DIRECTION_OUT:
				$content = sprintf('%sleave %s %s->%s',$indent,$pJoinPoint->NAME,$pJoinPoint->CLASS,$pJoinPoint->METHOD);
				self::$INDENT_COUNT -= 1;
				$instance->log($content);
				break;
			default:
				break;
		}
	}
}
