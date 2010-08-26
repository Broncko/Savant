<?php
namespace SavantTests\Webservice;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TXMLRPCClient extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\Webservice\CXMLRPCClient();
    }

    public function tearDown()
    {
        //$this->obj->disconnect();
        $this->obj = null;
    }

    public function testCall()
    {
        $res = $this->obj->call('call',array('Savant\\CBootstrap', 'getErrorType', 200));
        print_r($res);
    }
}
