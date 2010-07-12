<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the controller package Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage AOP
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

namespace Savant\Controller;

/**
 * @package    Savant
 * @subpackage AOP
 * Exception-handling for front controller
 *
 */
class EFrontController extends \Savant\EException {}


/**
 * @package    Savant
 * @subpackage AOP
 * provides front controller functionality
 * handles request from client and transforms it to needed data to proceed with the framework
 * 
 */
class CFrontController
{
	/*
	 * Parameter
	 * @var array
	 */
	private $params = array();
	
	/**
	 * Constructor
	 * @param array $pParams parameters
	 */
	public function __construct($pParams = null)
	{
		$this->params = (object)$pParams;
	}
	
	/**
	 * invoke class
	 * @param string $pClass class
	 * 
	 * @todo: this method does not makes much sense. what about passing values/parameters?
	 */
	public function invokeFactory($pClass = null)
	{
		if(null != $pClass)
		{
			return new $pClass;
		}
		throw new EFrontController('no class to invoke',111);
	}
	
	/**
	 * creates request handler
	 * @static main
	 * @return object
	 */
	public static function main()
	{
		$fc = new self;
		$obj = $fc->invokeFactory(str_replace('_','\\',$_REQUEST['class']));
		$rf = new \ReflectionObject($obj);
		if($rf->implementsInterface('Savant\IConfigure'))
		{
			$obj->configure($_REQUEST['conf']);
		}
		return $obj;
	}
	
}