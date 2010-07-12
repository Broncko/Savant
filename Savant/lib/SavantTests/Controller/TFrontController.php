<?php
namespace \SavantTests\Controller;

class TFrontController extends \Savant\ATestCase
{
	private $obj = null;
	
	public function setUp()
	{
		$this->obj = new \Savant\Controller\CFrontController();
	}
	
	public function tearDown()
	{
		
	}
	
	public function testMain()
	{
		$result = \Savant\Controller\CFrontController::main();
	}
}