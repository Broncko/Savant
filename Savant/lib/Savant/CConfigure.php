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
namespace Savant;
use \Savant\AOP;

/**
 * @package Savant
 * Exception-handling for Configuration
 *  
 */
class EConfigure extends EException {}

/**
 * @package Savant
 * Provides configuration handling
 *  
 */
class CConfigure
{
    /**
     * object to configure
     * @var \Savant\AStandardObject
     */
    private $configObj = null;

    /**
     * simplexml root
     * @var SimpleXMLElement
     */
    private $simpleXml = null;

    /**
     * Constructor
     * @param \Savant\AStandardObject $pObj object to configure
     */
    public function __construct($pObj)
    {
        $confFile = ($pObj instanceof AStandardObject ? $pObj->confFile : CBootstrap::getConfigFile(\get_class($pObj)));
        if(!file_exists($confFile))
        {
            throw new EConfigure('config file %s does not exist',$confFile, 120);
        }
        $this->simpleXml = self::load($pObj->confFile); //TODO: implement dtd validation
        $this->configObj = $pObj;
    }

    /**
     * load xml configuration file
     * @param string $pFile
     * @param boolean $pValidate
     * @return SimpleXMLElement
     */
    public static function load($pFile, $pValidate = false)
    {
        if($pValidate)
        {
            return \simplexml_load_file($pFile, '\SimpleXMLElement', \LIBXML_DTDVALID);
        }
        else
        {
            return \simplexml_load_file($pFile, '\SimpleXMLElement');
        }
    }

    /**
     * magic function __get
     * returns xml element from given section, same like @link getXmlRootObj
     * @param string $pSection section of configuration file
     * @return SimpleXMLElement section
     */
    public function __get($pSection)
    {
            return $this->simpleXml->{$pSection};
    }

    /**
     * magic function __set
     * set configuration property
     * @param string $pConfProp object property
     * @param mixed $pConfVal value
     * @return \Savant\AStandardObject configured object
     */
    public function __set($pConfProp = '', $pConfVal = '')
    {
            $this->configObj->{$pConfProp} = $pConfVal;
            return $this->configObj;
    }

    /**
     * returns root of xml configuration file
     * @return SimpleXMLElement
     */
    public function getXmlRootObj()
    {
            return $this->simpleXml;
    }

    /**
     * returns child elements from config section
     * @param SimpleXMLElement $pSection configuration section
     * @return array
     */
    public static function getConfigFromSection(\SimpleXMLElement $pSection)
    {
            if(!self::hasChilds($pSection))
            {
                    throw new EConfigure("Section has no child elements");
            }
            return $pSection->children();
    }

    /**
     * configures object
     * @param IConfigure $pObj object (call by reference)
     * @param string $pSection configuration section
     */
    public static function configure(&$pObj, $pSection = 'default')
    {
            $instance = new self($pObj);
            self::configureBySection($pObj, $instance->configurations->{$pSection});
    }

    /**
     * configures object from given xml element
     * @param IConfigure $pObj object (call by reference)
     * @param SimpleXMLElement $pSection configuration section
     */
    public static function configureBySection(&$pObj, \SimpleXMLElement $pSection)
    {
            if(!self::hasChilds($pSection))
            {
                    throw new EConfigure("Section has no child elements");
            }

            //configure object
            foreach($pSection->children() as $confProp => $confVal)
            {
                if($confVal->count() > 0)
                {
                    $pObj->{strtoupper($confProp)} = $confVal;
                }
                else
                {
                    $pObj->{strtoupper($confProp)} = sprintf('%s',$confVal);
                }
            }
            $pObj->config = $pSection;
    }

    /**
     * check if SimpleXMLElement has childs
     * @static
     * @param SimpleXMLElement $pSection xml element
     * @return bool
     */
    public static function hasChilds(\SimpleXMLElement $pSection)
    {
            if($pSection->count() == 0)
            {
                    return false;
            }
            return true;
    }

    /**
     * returns configuration from given class
     * @param string $pClass
     * @param string $pSection
     * @return SimpleXMLElement
     */
    public static function getClassConfig($pClass, $pSection = 'default')
    {
        $configFile = CBootstrap::getConfigFile($pClass);
        if(!\file_exists($configFile))
        {
            throw new EConfigure("no config file for class %s found",$pClass);
        }
        $config = self::load($configFile);
        return self::getConfigFromSection($config->configurations->{$pSection});
    }
}
