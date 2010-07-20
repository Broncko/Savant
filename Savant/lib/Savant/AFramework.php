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
abstract class AFramework
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

        /**
         *  @static initialize framework properties
         *
         */
        public static function initialize()
        {
            if(self::$STATUS == self::STATUS_ACTIVE)
            {
                return;
            }
            self::$STATUS = self::STATUS_INITIALIZING;
            self::$BASE_DIR = \realpath(dirname(__FILE__) . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . '..');
            self::$ROOT_DIR = \realpath(self::$BASE_DIR . \DIRECTORY_SEPARATOR . '..');
            self::$CONF_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'conf';
            self::$LIB_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'lib';
            self::$FRAMEWORK_DIR = self::$LIB_DIR . \DIRECTORY_SEPARATOR . 'Savant';
            self::$TESTS_DIR = self::$LIB_DIR . \DIRECTORY_SEPARATOR . 'SavantTests';
            \spl_autoload_register(array('Savant\AFramework','loadClass'),true);
            \register_shutdown_function(array('Savant\AFramework', 'finalize'));
            self::$STATUS = self::STATUS_ACTIVE;
        }

        /**
         * @static shutdown framework
         */
        public static function finalize()
        {
            self::$STATUS = self::STATUS_FINALIZING;
            //put code here, which will be executed when the framework shuts down or exit is called
            self::$STATUS = self::STATUS_INACTIVE;
        }

        /**
         * @static framwork class loader
         * @param string $pClass
         */
        public static function loadClass($pClass)
        {
            $pClass = str_replace('\\', \DIRECTORY_SEPARATOR, $pClass);
            $classPath = self::$LIB_DIR.\DIRECTORY_SEPARATOR.str_replace('_',\DIRECTORY_SEPARATOR,$pClass).'.php';
            if(!file_exists($classPath))
            {
                    throw new EException('class %s not found in %s', $pClass, $classPath, 200);
            }
            else
            {
                    require_once($classPath);
            }
        }
	
}