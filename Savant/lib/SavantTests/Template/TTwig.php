<?php
namespace SavantTests\Template;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TTwig extends \Savant\ATestCase
{
    private $obj;

    public function setUp()
    {
        $this->obj = new \Savant\Template\CTwig();
        $this->obj->testvar = "World";
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function loadTemplate()
    {
        $this->obj->loadTemplate('test.html');
    }

    public function testRender()
    {
        $res = $this->obj->render();
        print_r($res);
    }
}