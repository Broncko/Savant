<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TUnitTestResultParser extends \Savant\ATestCase
{
    protected $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\Utils\CUnitTestResultParser();
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testParse()
    {
        $res = $this->obj->parse();
        print_r($res);
    }
}
