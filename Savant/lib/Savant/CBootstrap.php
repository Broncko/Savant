<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
/**
 * TODO: seperate framework methods from bootstrap file. some methods like
 * extensionLoaded() or log() dont belong to the bootstrap sequence.
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
     * framework mode web
     * @var string
     */
    const MODE_WEB = 'web';

    /**
     * framework mode cli
     * @var string
     */
    const MODE_CLI = 'cli';

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
     * content type html
     * @var string
     */
    const CONTENT_TYPE_HTML = 'text/html';

    /**
     * content type xml
     * @var string
     */
    const CONTENT_TYPE_XML = 'text/xml';

    /**
     * content type for xmlrpc
     * @var string
     */
    const CONTENT_TYPE_XMLRPC = 'application/x-www-form-urlencoded';

    /**
     * framework state development
     * @var string
     */
    const STATE_DEVELOPMENT = 'dev';

    /**
     * framework state production (live)
     * @var string
     */
    const STATE_PRODUCTION = 'live';

    /**
     * framework mode
     * @var string
     */
    public static $MODE = self::MODE_WEB;

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
     * benchmark application
     * @var bool
     */
    public static $BENCHMARK = false;

    /**
     * framework execution state
     * @var string
     */
    public static $EXECUTE_STATE = self::STATE_DEVELOPMENT;

    /**
     * define logger
     * @var Savant\Utils\ILogging
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
     * skins folder
     * @var string
     */
    public static $SKINS_DIR;

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
     * data folder
     * @var string
     */
    public static $DATA_DIR;

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
     * class loaders
     * @var SplObjectStorage
     */
    private $classLoaders = null;



    /**
     * create bootstrapper instance
     */
    public function __construct()
    {
        try
        {
            $this->config = CConfigure::getClassConfig(\get_class($this));
            $this->classLoaders = new \SplObjectStorage();
        }
        catch(EException $e)
        {

        }
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
        self::$SKINS_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'skins';
        self::$FRAMEWORK_DIR = self::$LIB_DIR . \DIRECTORY_SEPARATOR . 'Savant';
        self::$TESTS_DIR = self::$LIB_DIR . \DIRECTORY_SEPARATOR . 'SavantTests';
        self::$EXT_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'ext';
        self::$DATA_DIR = self::$BASE_DIR . \DIRECTORY_SEPARATOR . 'data';
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

        if(isset($this->classLoaders) && $this->classLoaders->count() > 0)
        {
            foreach($this->classLoaders as $loader)
            {
                \spl_autoload_register($loader);
            }
        }
        
        \register_shutdown_function(array('Savant\CBootstrap', 'finalize'));

        if(isset($_SERVER['HTTP_USER_AGENT']))
        {
            self::$MODE = self::MODE_WEB;
        }
        else
        {
            self::$MODE = self::MODE_CLI;
        }

        self::$LOGGER = new Utils\CMultiLogging();
        self::$LOGGER->addLogger(new Utils\CFileLogging());

        self::initializeAOP();
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
            //silently stop if file not exists, cause maybe other classloaders
            //can find the file
            return false;
        }
        if(!include_once($classPath))
        {
            throw new EBootstrap("class %s could not be load from file %s", $pClass, $classPath);
        }
    }

    /**
     * register class loader
     * @param function $pCallback anonymus function to load classes
     */
    public function registerClassLoader($pCallback)
    {
        if(self::$STATUS == self::STATUS_ACTIVE)
        {
            \spl_autoload_register($pCallback);
        }
        else
        {
            $this->classLoaders->attach($pCallback);
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
    public static function initializeAOP()
    {
        if(count(AOP\AFramework::$pointcuts) == 0)
        {
            echo "is echt null - status: ".self::$STATUS."<br/>";
            AOP\AFramework::registerAspects();
        }
    }

    /**
     * run bootstrapper
     */
    public function run()
    {
        if(self::$STATUS == self::STATUS_ACTIVE)
        {
            echo "already active";
            return;
        }
        $this->initialize();
        self::$STATUS = self::STATUS_ACTIVE;
    }

    /**
     * log
     * @param string $pContent
     */
    public static function log($pContent)
    {
        if(isset(self::$LOGGER) && self::$LOGGER->count() > 0)
        {
            self::$LOGGER->log($pContent);
        }
    }

    /**
     * check if needed extension is loaded
     * @param string $pExtension
     */
    public static function extensionLoaded($pExtension)
    {
        if(!\extension_loaded($pExtension))
        {
            throw new EBootstrap("extension %s is not loaded, check php.ini configuration",$pExtension);
        }
    }

    /**
     * set content type
     * @param string $pType
     */
    public static function setContentType($pType)
    {
        if(\headers_sent())
        {
            \header_remove();
        }
        header(sprintf("Content-type: %s\r\n",$pType));
    }

    /**
     * invoke classmethod and return the result
     * @param string $pClass
     * @param string $pMethod
     * @return <type> mixed
     */
    public static function invoke($pClass, $pMethod = '__construct', $pArgs = array())
    {
        if(!\class_exists($pClass))
        {
            throw new EBootstrap("class %s dont exists", $pClass);
        }
        if(!\method_exists($pClass, $pMethod))
        {
            throw new EBootstrap("method %s of class %s dont exists", $pMethod, $pClass);
        }
        $res = \forward_static_call_array(array($pClass,$pMethod),$pArgs);
        return $res;
    }

    /**
     * get files of pType from pFolder
     * @param string $pFolder
     * @param string $pType
     * @return \RegexIterator
     */
    public static function getFiles($pFolder, $pType = 'php')
    {
        $Directory = new \RecursiveDirectoryIterator($pFolder, \FilesystemIterator::SKIP_DOTS);
        $Iterator = new \RecursiveIteratorIterator($Directory);
        $Regex = new \RegexIterator($Iterator, '/^.+\.'.$pType.'$/i', \RecursiveRegexIterator::GET_MATCH);
        return $Regex;
    }

    /**
     * returns a list of classes which extend the given subclass
     * TODO: test subclass filter
     * @param string $pSubclass
     * @return array
     */
    public static function getClasses($pSubclass = '', $pFilter = null)
    {
        $fileType = 'php';
        foreach(self::getFiles(self::$FRAMEWORK_DIR, $fileType) as $phpFile)
        {
            //replace directory, filesuffix and turn slash
            $class = __NAMESPACE__.str_replace(array(self::$FRAMEWORK_DIR,'/','.'.$fileType), array('', '\\',''), $phpFile[0]);
            $rf = new \ReflectionClass($class);
            if($rf->isInterface())
            {
                continue;
            }
            if($pSubclass != '' && !$rf->isSubclassOf($pSubclass))
            {
                continue;
            }
            $res[] = $class;
        }
        if(!\is_null($pFilter))
        {
            \array_filter($res, $pFilter);
        }
        return $res;
    }

    /**
     * returns classes which implements given interface
     * @param string $pInterface
     * @return array
     */
    public static function getClassesWithInterface($pInterface)
    {
        return self::getClasses('',
            function($class)
            {
                $rf = new \ReflectionClass($class);
                if($rf->implementsInterface($pInterface))
                {
                    return $class;
                }
                else
                {
                    return false;
                }
            }
        );
    }
}