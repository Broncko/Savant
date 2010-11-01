<?php
namespace SavantTests\Storage;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TCouchDb extends \Savant\ATestCase
{
    private $obj;

    public function setUp()
    {
        $this->obj = new \Savant\Storage\CCouchDb();
    }

    public function testCreateDb()
    {
        $this->obj->createDb("BronckoDb");
    }

    public function tearDown()
    {

    }
}