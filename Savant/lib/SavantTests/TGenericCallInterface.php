<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TGenericCallInterface extends \Savant\ATestCase
{
    public function setUp() {}

    public function tearDown() {}

    public function testGetCallMode()
    {
        $class = '\Savant\Controller\CFrontController';
        $method = 'invokeFactory';
        $res = \Savant\AGenericCallInterface::getCallMode($class, $method);
        $this->assertEquals(\Savant\AGenericCallInterface::MODE_STATIC,$res);
    }

    /**
     * @depends testGetCallMode
     */
    public function testStaticCall()
    {
        //use error code of LEVEL_CRITICAL as argument
        $args = array(\Savant\AFramework::getErrorCode(\Savant\AFramework::LEVEL_CRITICAL));
        //set static mode for static call
        $opts = array('mode'=> \Savant\AGenericCallInterface::MODE_STATIC);

        $res = \Savant\AGenericCallInterface::call('\Savant\AFramework','getErrorType',$args,$opts);
        $this->assertEquals(\Savant\AFramework::LEVEL_CRITICAL,$res);
    }

    /**
     * @depends testGetCallMode
     */
    public function testObjectCall()
    {
        $args = array('\Savant\Service\CBitly');
        $opts = array('mode' => \Savant\AGenericCallInterface::MODE_OBJECT);
        $res = \Savant\AGenericCallInterface::call('\Savant\Controller\CFrontController', 'invokeFactory', $args, $opts);
        $this->assertTrue($res instanceof \Savant\Service\CBitly);
    }
}