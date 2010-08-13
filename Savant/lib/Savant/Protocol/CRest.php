<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage AOP
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Protocol;

/**
 * @package    Savant
 * @subpackage Protocol
 * Exception-handling for Rest-API
 *  
 */
class ERest extends \Savant\EException { }

/**
 * @package    Savant
 * @subpackage Protocol
 * handles REST-Requests
 * 
 */
abstract class CRest extends \Savant\AStandardObject
{
	/**
	 * Constructor
	 */
	public function __construct($pConfig = 'default')
	{
            parent::__construct($pConfig);
	}
	
	/**
	 * handles rest get requests
	 * 
	 * @param string $pUrl request url
	 * @return string result of the request
	 */
	public function _getRequest($pUrl)
	{
		return file_get_contents($pUrl);
	}
}
