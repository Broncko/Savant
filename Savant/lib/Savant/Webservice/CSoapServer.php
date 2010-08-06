<?php
namespace Savant\Webservice;

class ESoapServer extends \Savant\EException {}

class CSoapServer extends \Savant\AStandardObject implements \Savant\IConfigure 
{
	public $WSDL = null;
	
	public $USERNAME = null;
	
	public $PASSWORD = null;
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function _querySomething()
	{
		echo "query something - magic function";
	}
}
