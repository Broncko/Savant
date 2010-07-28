<?php
namespace SavantTests\Storage;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TDatabase extends \Savant\ATestCase
{
    protected $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\Storage\CDatabase();
    }
    public function tearDown()
    {
        $this->obj = null;
    }

    public function testTest()
    {
        echo "Hello World";
    }
}
