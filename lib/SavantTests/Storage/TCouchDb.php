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

    public function xtestCreateDb()
    {
        $this->obj->createDb("testdb");
    }

    public function xtestCreateDocument()
    {
        $this->obj->createDocument("testdoc", array("_id"=>"123", "name"=>"Broncko", "age"=>"25"));
    }

    public function testGetUuid()
    {
        $this->obj->getUuid(7);
    }

    public function tearDown()
    {

    }
}