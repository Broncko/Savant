<?php
namespace SavantTests\Service;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TBitly extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\Service\CBitly();
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testGetShortUrl()
    {
        $res = $this->obj->getShortUrl('http://www.google.de');
        print_r($res);
    }
}