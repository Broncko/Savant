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
require_once 'EException.php';
require_once 'CConfigure.php';

/**
 * @package Savant
 * Exception-handling for framework class
 *
 */
class EBootstrap extends EException {}

/**
 * @package Savant
 * holds information and helper functions for the framework
 */
final class CBootstrap
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
         * framework status initializing
         * @var integer
         */
        const STATUS_INITIALIZING = 0;

        /**
         * framework status active
         * @var integer
         */
        const STATUS_ACTIVE = 1;

        /**
         * framework status inactive
         * @var integer
         */
        const STATUS_INACTIVE = 2;

        /**
         * framework status finalizing
         * @var integer
         */
        const STATUS_FINALIZING = 3;
	
	/**
	 * log level
	 * @var string
	 */
	public static $LEVEL = self::LEVEL_DEBUG;

        /**
         * current framework status
         * @var integer
         */
        public static $STATUS = self::STATUS_INACTIVE;
	
	/**
	 * permanent logging
	 * @var bool
	 */
	public static $PERMANENT_LOG = true;

        /**
         * define logger
         * @var ILogging
         */
        public static $LOGGER = null;

        /**
         * base folder
         * @var string
         */
        public static $BASE_DIR;

        /**
         * root folder
         * @var string
         */
        public static $ROOT_DIR;

        /**
         * library folder
         * @var string
         */
        public static $LIB_DIR;

        /**
         * framework folder
         * @var string
         */
        public static $FRAMEWORK_DIR;

        /**
         * unit tests folder
         * @var string
         */
        public static $TESTS_DIR;

        /**
         * configuration folder
         * @var string
         */
        public static $CONF_DIR;

        /**
         * extension folder
         * @var string
         */
        public static $EXT_DIR;

        /**
         * aspects folder
         * @var string
         */
        public static $ASPECT_DIR;

        /**
         * joinpoints folder
         * @var string
         */
        public static $JOINPOINT_DIR;

        /**
         * bootstrap configuration
         * @var \Savant\CConfiguration
         */
        private $config = null;

        /**
         * create bootstrapper instance
         */
        public function __construct()
        {
            $this->config = CConfigure::getClassConfig(\get_class($this));
        }

	/**
         * get error code from error level
	 * @static getErrorCode
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
         * get error type from error code
	 * @static getErrorType
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

        /**
         * set bootstrapper properties
         * @static setProperties
         */
        public static function setProperties()
        {
            self::$BASE_DIR = \realpath(dirname(__FILE__) . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . '..');
            self::$ROOT_DIR = \realpath(self::$BASE_DIR . \DIRECTORY_SEPARATOR . '..');
            self::$CONF_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'conf';
            self::$LIB_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'lib';
            self::$FRAMEWORK_DIR = self::$LIB_DIR . \DIRECTORY_SEPARATOR . 'Savant';
            self::$TESTS_DIR = self::$LIB_DIR . \DIRECTORY_SEPARATOR . 'SavantTests';
            self::$EXT_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'ext';
            self::$ASPECT_DIR = self::$FRAMEWORK_DIR . \DIRECTORY_SEPARATOR . 'AOP' .\DIRECTORY_SEPARATOR . 'Aspects';
            self::$JOINPOINT_DIR = self::$FRAMEWORK_DIR . \DIRECTORY_SEPARATOR . 'AOP' .\DIRECTORY_SEPARATOR . 'JoinPoints';
        }

        /**
         * initialize bootstrapper
         */
        public function initialize()
        {
            self::$STATUS = self::STATUS_INITIALIZING;
            self::setProperties();

            \spl_autoload_register(array('Savant\CBootstrap','loadClass'),true);
            \register_shutdown_function(array('Savant\CBootstrap', 'finalize'));

            self::$LOGGER = new Utils\CMultiLogging();
            self::$LOGGER->addLogger(new Utils\CFileLogging());
            
            $this->initializeAOP();
        }

        /**
         * shutdown framework
         * @static finalize
         */
        public static function finalize()
        {
            self::$STATUS = self::STATUS_FINALIZING;
            //put code here, which will be executed when the framework shuts down or exit is called
            self::$STATUS = self::STATUS_INACTIVE;
        }

        /**
         * framework class loader
         * @static loadClass
         * @param string $pClass
         */
        public static function loadClass($pClass)
        {
            $pClass = str_replace('\\', \DIRECTORY_SEPARATOR, $pClass);
            $classPath = self::$LIB_DIR.\DIRECTORY_SEPARATOR.str_replace('_',\DIRECTORY_SEPARATOR,$pClass).'.php';
            if(!file_exists($classPath))
            {
                    throw new EException('class %s not found in %s', $pClass, $classPath);
            }
            else
            {
                    require_once($classPath);
            }
        }

        /**
         * returns path to config file from given class
         * @static getConfigFile
         * @param string $pClass
         * @return string
         */
        public static function getConfigFile($pClass)
        {
            return self::$CONF_DIR.\DIRECTORY_SEPARATOR.str_replace('\\',\DIRECTORY_SEPARATOR,$pClass).'.conf.xml';
        }

        /**
         * initialize aop framework
         */
        public function initializeAOP()
        {
            AOP\AFramework::registerAspects();
        }

        /**
         * run bootstrapper
         */
        public function run()
        {
            if(self::$STATUS == self::STATUS_ACTIVE)
            {
                return;
            }
            $this->initialize();
            self::$STATUS = self::STATUS_ACTIVE;
        }

        public static function log($pContent)
        {
            self::$LOGGER->log($pContent);
        }

	
}