<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

namespace Savant;

use Savant\Utils;

/**
 * @package Savant
 * This class wraps the native PHP-Exception class, to add some useful functionality
 * message-handling can now be used like printf
 *
 */
class EException extends \Exception 
{									
	/**
	 * Constructor
	 * @param string $pMessage error message
	 * @param string $pLevel error level
	 * @param array $pArgs arguments used by message
	 */
	public function __construct($pMessage = '', $pLevel = null, $pArgs = array())
	{
		$code = AFramework::getErrorCode($pLevel);
		if(count($pArgs) > 0)
		{
			parent::__construct(vsprintf($pMessage,$pArgs),$code);
		}
		else
		{
			parent::__construct($pMessage,$code);
		}
		if(AFramework::$PERMANENT_LOG && $code >= AFramework::getErrorCode(AFramework::$LEVEL))
		{
			$this->log();
		}
	}
	
	/**
	 * magic function __toString
	 * @return string trace
	 */
	public function __toString()
	{
		$ret = $this->getFile().' :: line '.$this->getLine()." -> ".$this->getCode()."; ".$this->getMessage()."<br/>";
		foreach($this->getTrace() as $traceline)
		{
			$ret .= $traceline["file"].' :: line '.$traceline["line"]." -> ".$traceline["function"]."(".implode(",",$traceline["args"]).")<br/>";
			$ret .= self::getLOC($traceline['file'],$traceline['line'])."<br/>";
		}
		return $ret;
	}
	
	/**
	 * logs exception to file
	 */
	public function log()
	{	
		$content = $this->getMessage().' '.$this->getFile().' :: line '.$this->getLine();
		$logger = new Utils\CFileLogging();
		$logger->log($content, AFramework::getErrorType($this->getCode()));
	}
	
	/**
	 * @static get line of code
	 * @param string $pFile path to file
	 * @param integer $pLine line
	 * @return string line of code
	 */
	private static function getLOC($pFile = '', $pLine)
	{
		$lineArr = file($pFile);
		return $lineArr[$pLine-1];
	}
}
