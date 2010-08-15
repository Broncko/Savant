<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class testClass extends \Savant\AStandardObject implements \Savant\IConfigure
{
    const returnValue = "Hallo Broncko";

    public function __construct()
    {
        self::$_DTD_VALID = false;
        parent::__construct();
    }

    public function _testMethod()
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
            $res = $this->obj->testMethod();
            $this->assertEquals($res, testClass::returnValue);
        }
}
