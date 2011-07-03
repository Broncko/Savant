<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class testClass extends \Savant\AStandardObject implements \Savant\IConfigure
{
    const returnValue = "Hallo Broncko";

    public function __construct()
    {
        parent::__construct();
    }

    public function _testMethod($pVar1, $pVar2)
    {
        return self::returnValue;
    }
}

class TStandardObject extends \Savant\AAutoTestCase
{
	public $obj = null;
	
	public function setUp()
	{
            $this->obj = new testClass();
	}
	
	public function tearDown()
	{
            $this->obj = null;
	}

        public function testConfFile()
        {
            $this->assertTrue(\file_exists($this->obj->confFile));
        }

        public function testConfContent()
        {
            $this->assertEquals('bronckotest.log',$this->obj->LOGFILE);
        }

        public function testAOPMethodCall()
        {
            $res = $this->obj->testMethod('var1','var2');
            $this->assertEquals($res, testClass::returnValue);
        }
}
