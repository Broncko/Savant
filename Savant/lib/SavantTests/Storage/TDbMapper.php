<?php
namespace SavantTests\Storage;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class test extends \Savant\Storage\CValueObject
{
    public $name = 'broncko';
    public $coolness = true;
    public $hungry = 'yes';
}

class TDbMapper extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $valObj = new test();
        $this->obj = new \Savant\Storage\CDbMapper($valObj);
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testMap()
    {
        print_r($this->obj->map());
    }
}