<?php
namespace SavantTests\Storage\DataSet;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TDataSet extends \Savant\ATestCase
{
    private $obj;

    public function setUp()
    {
        $testArr = array(
            array("name" => "Hendrik", "alter" => "25", "beruf" => "entwickler"),
            array("name" => "Brocnko", "alter" => "3", "beruf" => "nickes")
        );
        $this->obj = new \Savant\Storage\DataSet\CDataSet($testArr);
    }

    public function tearDown() {}

    public function testCount()
    {
        $res = $this->obj->count();
        $this->assertEquals(2, $res);
    }

    /**
     * @depends testCount
     */
    public function testAddRow()
    {
        $newArr = array('name' => 'John Doe', 'alter' => 'unknown', 'beruf' => 'victim');
        $this->obj->addRow($newArr);
        $res = $this->obj->count();
        $this->assertEquals(3, $res);
    }

    public function testGetFieldNames()
    {
        $res = $this->obj->getFieldNames();
        $this->assertTrue(\is_array($res));
    }

    public function testGetDataAsArray()
    {
        $res = $this->obj->getDataAsArray();
        $this->assertEquals(2, count($res));
    }
}