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
	 * contains content of the xml configuration section
	 * @var SimpleXMLElement
	 */
	public $config = null;
	
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
            $this->confFile = CBootstrap::getConfigFile(\get_class($this));
            AOP\AFramework::weave($this, new AOP\JoinPoints\CConstructor(\get_class($this)));
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
                $joinPoint = new AOP\JoinPoints\CMethodCall(\get_class($this), $pMethod, $pArgs);
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
		return $this->config->{$pName};
	}
	
	/**
	 * Destructor
	 */
	public function __destruct()
	{
            AOP\AFramework::weave($this, new AOP\JoinPoints\CDestructor(\get_class($this)));
	}
}