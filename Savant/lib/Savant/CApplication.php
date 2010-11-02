<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;

/**
 * @package Savant
 * exception handling of AAplication
 */
class EApplication extends EException {}

/**
 * @package Savant
 * provides an application template
 */
class CApplication implements IApplication
{
    /**
     * application name
     * @var string
     */
    public static $NAME;

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
     * configuration folder
     * @var string
     */
    public static $CONF_DIR;

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
     * cache data folder
     * @var string
     */
    public static $CACHE_DIR;
    
    /**
     * use default folder structure if set to true
     * @var boolean
     */
    public static $DEFAULT_FOLDER_STRUCTURE = true;

    /**
     * create application instance
     * @param string $pName
     */
    public function __construct($pName = '')
    {
        self::$NAME = $pName;
    }

    /**
     * return base dir
     * @param string $pFile
     * @return string
     */
    protected static function getBaseDir($pFile)
    {
        return \realpath(dirname($pFile) . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . '..');
    }

    /**
     * set default folder structure below basedir
     * @param $pBaseDir
     */
    public static function setFolderStructure($pBaseDir)
    {
        self::$ROOT_DIR = \realpath($pBaseDir . \DIRECTORY_SEPARATOR . '..');
        self::$CONF_DIR = $pBaseDir . \DIRECTORY_SEPARATOR . 'conf';
        self::$LIB_DIR = $pBaseDir . \DIRECTORY_SEPARATOR . 'lib';
        self::$SKINS_DIR = $pBaseDir . \DIRECTORY_SEPARATOR . 'skins';
        self::$CACHE_DIR = $pBaseDir . \DIRECTORY_SEPARATOR . 'cache';
    }

    /**
     * default class loader
     * @param string $pClass
     */
    public static function loadClass($pClass)
    {
        $pClass = str_replace('\\', \DIRECTORY_SEPARATOR, $pClass);
        $classPath = function($class)
        {
            return CApplication::$LIB_DIR.\DIRECTORY_SEPARATOR.str_replace('_',\DIRECTORY_SEPARATOR,$class).'.php';
        };
        //if default classname exists as filename
        if(!\file_exists($classPath($pClass)))
        {
            /*if not try to find filenames which define baseclasses and have also
              abstract classes or classes that derive from eexception in the same
              file*/
            $addClassPrefix = function($prefix) use ($pClass)
            {
                $classParts = \explode('/', $pClass);
                //if class is an exception class replace first letter with prefix
                if($classParts[\count($classParts)-1][0] == 'E')
                {
                    $classParts[\count($classParts)-1][0] = $prefix;
                    return $pClass = \implode('/', $classParts);
                }
            };
            //use C for standard class definitions
            $pClass = (file_exists($classPath($addClassPrefix('C'))) ? $addClassPrefix('C') : false);
            //use A for abstract classes
            $pClass = (file_exists($classPath($addClassPrefix('A'))) ? $addClassPrefix('A') : false);
            if(!$pClass)
            {
                return false;
            }
        }
        if(!include_once($classPath($pClass)))
        {
            throw new EApplication("class %s could not be load from file %s", $pClass, $classPath);
        }
    }
}