<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage AOP
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Service\Google;

/**
 * @package    Savant
 * @subpackage Service
 * Exception-handling for Rest-API
 *  
 */
class EChartApi extends \Savant\EException {}

/**
 * @package    Savant
 * @subpackage Service
 * Wrapper of googles chart-api.
 *  
 */
class CChartApi extends \Savant\AStandardObject
{
	/**
	 * default api url, without parameters
	 * @var string
	 */
	public API_URL = 'http://chart.apis.google.com/chart';
	
	/**
	 * holds params to add to API_URL
	 * @var array 
	 */
	private $UrlParams = array();
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * set chart type
	 * @param string $pType type
	 */
	public function setChartType($pType = '')
	{
		
	}
	
	/**
	 * add parameter to url
	 * @param string $pParam parameter
	 * @param mixed $pVal value
	 */
	private function addUrlParam($pParam = null, $pVal = null)
	{
		
	}
	
	/**
	 * buildUrl
	 */
	private function buildUrl()
	{
		
	}
	
	/**
	 * render
	 */
	private function render()
	{
		
	}
}
