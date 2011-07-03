<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class configClass extends \Savant\AStandardObject {}

class TConfigure extends \Savant\ATestCase
{
	public $obj;
	
	public function setUp()
	{
            $this->obj = new \Savant\CConfigure(new configClass(),true);
	}
	
	public function tearDown()
	{
            $this->obj = null;
	}
	
	public function testGetXmlRootObj()
	{
            $root = $this->obj->getXmlRootObj();

            $this->assertTrue($root instanceof \SimpleXMLElement);
            $this->assertObjectHasAttribute('configurations',$root);

            return $root;
	}

        /**
         * @depends testGetXmlRootObj
         */
        public function testHasChilds($pSection)
        {
            $this->assertTrue(\Savant\CConfigure::hasChilds($pSection));
        }

        /**
         * @depends testGetXmlRootObj
         */
        public function testGetConfigFromSection($pSection)
        {
            $this->assertObjectHasAttribute('logfile',$this->obj->getConfigFromSection($pSection->configurations->default));
        }

        /**
         * @depends testGetXmlRootObj
         */
        public function testConfigureBySection($pSection)
        {
            $test = new testClass();
            $this->assertEquals('',$test->LOGFILE);
            \Savant\CConfigure::configureBySection($test, $pSection->configurations->default);
            $this->assertEquals('bronckotest.log',$test->LOGFILE);
        }

        public function testConfigure()
        {
            $test = new testClass();
            $this->assertEquals('',$test->LOGFILE);
            $this->obj->configure($test);
            $this->assertEquals('bronckotest.log',$test->LOGFILE);
        }

        /*public function testException()
        {
            $test = new testClass();
            try
            {
                \Savant\CConfigure::configureBySection($test, new \SimpleXMLElement('<root></root>'));
            }
            catch(\Savant\EConfigure $e)
            {
                echo "hello world";
                echo \get_class($e);
            }
        }*/
}