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
 * TODO: build joinpoint stack -> has moved to aop framework
 */

namespace Savant;

use Savant\AOP;

/**
 * @abstract AStandardObject
 * @package Savant
 * Main class, which encapsules basic functionality of all objects. It defines the top of the class tree
 * every new class should extend from this. (wait a minute, godclasses are evil!)
 *
 * TODO: try to seperate extending classes!
 * 
 */
abstract class AStandardObject
{
	/**
	 * Logfile 
	 * @var string
	 */
	public $LOGFILE = null;
	
	/**
	 * file containing class configuration
	 * @var string
	 */
	public $confFile = null;
	
	/**
	 * class
	 * @var string
	 */
	protected $_class = null;
	
	/**
	 * contains content of the xml configuration section
	 * @var SimpleXMLElement
	 */
	protected $_configuration = null;
	
	/**
	 * contains aspects which belong to the class
	 * @var array
	 */
	protected $_aspects = null;

        /**
         * set dtd validation when config is being loaded
         * @var boolean
         */
        protected static $_DTD_VALID = true;
	
	/**
	 * Constructor
	 * @param string $pConfig section of the configuration file
	 */
	public function __construct($pConfig = 'default')
	{
            $this->_class = get_class($this);
            $this->confFile = CBootstrap::getConfigFile($this->_class);
            AOP\AFramework::weaveIn($this, new AOP\JoinPoints\CConstructor($this->_class));
	}
	
	/**
	 * Configures object
	 * puts data from the configuration section in the xml files into capitalized class members
	 * @param string $pConfigSection section of the xml configuration file
	 */
	public function configure($pConfigSection = 'default')
	{
            try
            {
                $config = new CConfigure($this, self::$_DTD_VALID);
                $xmlRoot = $config->getXmlRootObj();
                if(CConfigure::hasChilds($xmlRoot->configurations->{$pConfigSection}))
                {
                    foreach($config->getConfigFromSection($xmlRoot->configurations->{$pConfigSection}) as $prop => $val)
                    {
                        if(count($val) > 0)
                        {
                            $this->{\strtoupper($prop)} = $val;
                        }
                        else
                        {
                            $this->{\strtoupper($prop)} = \sprintf('%s',$val);
                        }
                    }
                }
                if(CConfigure::hasChilds($xmlRoot->joinpoints))
                {
                    $this->_aspects = $config->getConfigFromSection($xmlRoot->joinpoints);
                }
            }
            catch(EConfigure $e)
            {
                $e->log();
            }
	}
	
	/**
	 * Set configuration property manually
	 * @param string $pProperty class property
	 * @param mixed $pValue value
	 */
	public function setConfProperty($pProperty = '', $pValue = '')
	{
		$this->_configuration->$pProperty = $pValue;	
	}
	
	/**
	 * magic funtion __call
	 * implements aop functionality by invoking methods which have a underscore(_) prefix
	 * and weave in aspects before and after method
	 * @param string $pMethod methodname
	 * @param array $pArgs arguments
	 */
	public function __call($pMethod = '', $pArgs = array())
	{
		$aspectMethod = '_'.$pMethod;
                $joinPoint = new AOP\JoinPoints\CMethodCall($this->_class, $pMethod, $pArgs);
                AOP\AFramework::weaveIn($this, $joinPoint);
		$joinPoint->result = call_user_method_array($aspectMethod,$this,$pArgs);
                AOP\AFramework::weaveOut($this, $joinPoint);
		return $joinPoint->result;
	}
	
	/**
	 * magic function __get
	 * returns the object itself
	 * @param string $pName
	 */
	public function __get($pName)
	{
		return $this;
	}
	
	/**
	 * magic function __set
	 * returns the object itself
	 * @param string $pName
	 * @param mixed $pVal
	 */
	public function __set($pName, $pVal)
	{
		return $this;
	}
	
	/**
	 * Destructor
	 */
	public function __destruct()
	{
		
	}
}