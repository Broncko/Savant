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

/**
 * TODO: do this more api-conform.
 */

namespace Savant;

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
	public function __construct(AStandardObject $pObj)
	{
		if(!($pObj instanceof IConfigure))
		{
			throw new EConfigure('try to configure object of type %s which does not implements IConfigure Interface',get_class($pObj),300);
		}
		if(!file_exists($pObj->confFile))
		{
			throw new EConfigure('config file %s does not exist',$pObj->confFile, 120);
		}
		$this->simpleXml = simplexml_load_file($pObj->confFile);	
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
	public function getConfigFromSection(\SimpleXMLElement $pSection)
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
	public static function configure(IConfigure &$pObj, $pSection = 'default')
	{
		$instance = new self($pObj);
		self::configureBySection($pObj, $instance->configurations->{$pSection});
	}
	
	/**
	 * configures object from given xml element
	 * @param IConfigure $pObj object (call by reference)
	 * @param SimpleXMLElement $pSection configuration section
	 */
	public static function configureBySection(IConfigure &$pObj, \SimpleXMLElement $pSection)
	{
		if(!self::hasChilds($pSection))
		{
			throw new EConfigure("Section has no child elements");
		}
		
		//configure object
		foreach($pSection->children() as $confProp => $confVal)
		{
			$pObj->{strtoupper($confProp)} = $confVal;
		}
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
}
