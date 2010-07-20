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

/**
 * TODO: exception output has to be a template
 * TODO: seperate output from exception class
 */
namespace Savant;

use \Savant\Utils;

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
		//print_r($this);
                $trace = $this->getTrace();
                $firstTrace = \array_shift($trace);
                $ret = "<h3>Error</h3><br/>";
                $ret .= $this->getCode().' '.$this->getMessage().'<br/>';
                $ret .= $this->getFile().' line '.$this->getLine().'<br/>';
                $ret .= (!empty($firstTrace["class"])?$firstTrace["class"].$firstTrace["type"].$firstTrace["function"]:$firstTrace["function"]).'()<br/>';
                $ret .= implode('<br/>',self::getLOC($this->getFile(), $this->getLine(), 3)).'<br/><hr/>';
		foreach(\array_reverse($this->getTrace(), true) as $traceline)
                {
                    $sloc = '';
                    $traceline["line"] -= 1;
                    if(!empty($traceline["file"]) && !empty($traceline["line"]))
                    {
                        $ret .= $traceline["file"].' line '.$traceline["line"].'<br/>';
                        $sloc = self::getLOC($traceline["file"], $traceline["line"], 3);
                    }
                    if(!empty($traceline["class"]))
                    {
                        $ret .= $traceline["class"].$traceline["type"];
                    }
                    if(!empty($traceline["function"]))
                    {
                        $ret .= $traceline["function"].'()<br/>';
                    }
                    if(!empty($sloc))
                    {
                        foreach($sloc as $lineNumber => $line)
                        {
                            $ret .= $lineNumber.($lineNumber==$traceline["line"]?'*':'').' '.$line.'<br/>';
                        }
                    }
                    $ret .= '<hr/>';
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
         * @param integer $pLineDiff difference between first and last line
	 * @return string line of code
	 */
	private static function getLOC($pFile = '', $pLine = 0, $pLineDiff = 0)
	{
		$lineArr = file($pFile);
                if($pLineDiff != 0)
                {
                    for($counter = $pLine-$pLineDiff; $counter <= $pLine+$pLineDiff; $counter++)
                    {
                        $lines[$counter] = $lineArr[$counter];
                    }
                    return $lines;
                }
		return $lineArr[$pLine-1];
	}
}
