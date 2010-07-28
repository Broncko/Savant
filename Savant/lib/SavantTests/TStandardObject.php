<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class testClass extends \Savant\AStandardObject implements \Savant\IConfigure {}

class TStandardObject extends \Savant\ATestCase
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

        /**
         * @depends testConfFile
         */
        public function testConfContent()
        {
            $this->assertEquals('bronckotest.log',$this->obj->LOGFILE);
        }
}
