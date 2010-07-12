<?php
namespace \SavantTests;

class TStandardObject extends \Savant\ATestCase
{
	public $obj = null;
	
	public function setUp()
	{
		$this->obj = new \Savant\CStandardObject();
	}
	
	public function tearDown()
	{
		
	}
}
