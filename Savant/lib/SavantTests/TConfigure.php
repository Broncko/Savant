<?php
namespace SavantTests;

require_once '../Savant/ATestCase.php';

class TConfigure extends \Savant\ATestCase
{
	public $obj;
	
	public function setUp()
	{
		$this->obj = new \Savant\CConfigure();
	}
	
	public function tearDown()
	{
		$this->obj = null;
	}
	
	public function testgetXmlRootObj()
	{
		$this->assertEqual(true, ($this->obj instanceof SimpleXMLElement));
	}
}