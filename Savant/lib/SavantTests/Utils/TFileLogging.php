<?php
namespace SavantTests\Utils;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TFileLogging extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\Utils\CFileLogging();
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testLog()
    {
        $this->obj->log("log ma das hier");
    }
}