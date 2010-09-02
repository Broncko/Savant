<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

/**
 * TODO: exception output has to be a template
 * TODO: seperate output from exception class
 * TODO: check why Exceptions could not be called properly
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
	public function __construct()
	{
            $args = \func_get_args();
            $message = \array_shift($args);
            if(count($args) > 0)
            {
                parent::__construct(vsprintf($message,$args)."\n");
            }
            else
            {
                parent::__construct($message."\n");
            }
            if(CBootstrap::$PERMANENT_LOG)
            {
                if(CBootstrap::$STATUS == CBootstrap::STATUS_ACTIVE)
                {
                    $joinPoint = new AOP\JoinPoints\CException($this);
                    AOP\AFramework::weave(null, $joinPoint);
                }
                else
                {
                    CBootstrap::log($this->getMessage());
                }
            }
	}
	
	/**
	 * magic function __toString
	 * @return string trace
	 */
	public function __toString()
	{
            if(CBootstrap::$MODE == CBootstrap::MODE_CLI)
            {
                return $this->getTraceAsString();
            }
            else
            {
                $trace = $this->getTrace();
                
                $firstTrace = \array_shift($trace);

                $ret = (!empty($firstTrace["class"])?$firstTrace["class"].$firstTrace["type"].$firstTrace["function"]:$firstTrace["function"]).'()<br/>';
                $ret = \implode(self::getLOC($this->getFile(), $this->getLine(), 5));
                return \highlight_string("<?php\n".$ret,true);
                foreach(self::getLOC($this->getFile(), $this->getLine(), 5) as $lineNumber => $line)
                {
                    $ret .= $lineNumber.($lineNumber==$this->getLine()?'*':'').' '.$line;
                }
                
                return $ret;
                /*foreach(\array_reverse($this->getTrace(), true) as $traceline)
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
                }*/

                $errTplFile = CBootstrap::$SKINS_DIR . \DIRECTORY_SEPARATOR . 'error' . Template\CChunk::SUFFIX;
                $errTpl = new Template\CChunk();
                $errTpl->setTemplate($errTplFile);
                $errTpl->code = $this->getCode();
                $errTpl->message = $this->getMessage();
                $errTpl->trace = $ret;
                return $errTpl->render(false);
            }
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
                    $lines[$counter+1] = $lineArr[$counter];
                }
                return $lines;
            }
            return $lineArr[$pLine-1];
	}
}
