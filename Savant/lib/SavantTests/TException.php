<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TException extends \Savant\ATestCase
{
    protected $obj = null;

    public function setUp()
    {
        \Savant\AFramework::$PERMANENT_LOG = false;
        $this->obj = new \Savant\EException('gimme an error', \Savant\AFramework::LEVEL_INFO, array('error1','info1','debug please'));
    }

    public function tearDown()
    {
        $this->obj = null;
    }
}