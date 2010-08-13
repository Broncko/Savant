<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class testClass extends \Savant\AStandardObject implements \Savant\IConfigure
{
    public function __construct()
    {
        self::$_DTD_VALID = false;
        parent::__construct();
    }

    public function _testMethod()
    {
        return "Hallo Broncko";
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

        public function xtestConfFile()
        {
            $this->assertTrue(\file_exists($this->obj->confFile));
        }

        public function xtestConfContent()
        {
            $this->assertEquals('bronckotest.log',$this->obj->LOGFILE);
        }

        public function testAOPMethodCall()
        {
            $res = $this->obj->testMethod();
            print_r($res);
        }
}
