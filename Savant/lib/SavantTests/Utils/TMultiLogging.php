<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TMultiLogging extends \Savant\ATestCase
{
    private $obj;

    public function setUp()
    {
        $this->obj = new \Savant\Utils\CMultiLogging();
    }

    public function tearDown()
    {

    }

    public function testAddLogger()
    {
        $this->obj->addLogger(new \Savant\Utils\CFileLogging());
    }

    public function testLog()
    {
        $this->obj->log('debug multilogger');
    }
}