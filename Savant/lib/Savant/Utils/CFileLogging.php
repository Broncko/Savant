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
 */
class CFileLogging extends \Savant\AStandardObject implements ILogging, \Savant\IConfigure
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
     * log indent
     * @var string
     */
    const LOG_INDENT = '    ';

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
     * logging template
     * @var string
     */
    public $LOGTEMPLATE = self::DEFAULT_TPL;

    /**
     * Constructor
     * @param string $pLogfile path to logfile
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    /**
     * get current log indent
     * @return string
     */
    public static function getIndent()
    {
        return \str_repeat(self::LOG_INDENT, self::$INDENT_COUNT);
    }

    /**
     * log
     * @param string $pText content
     * @param string $pLevel loglevel
     */
    public function log($pText = '', $pLevel = \Savant\CBootstrap::LEVEL_DEBUG)
    {
        if(!\file_exists($this->LOGFILE))
        {
            return;
        }
        $content = str_replace('%CONTENT',$pText,self::DEFAULT_TPL);
        $content = str_replace('%LEVEL',$pLevel,$content);
        $content = str_replace('%TIMESTAMP',date('Y/m/d H:i:s'),$content);
        $content = str_replace('%PID',getmypid(),$content);

        file_put_contents($this->LOGFILE, $content.self::CR, FILE_APPEND);
    }
}
