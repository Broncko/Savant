<?php
namespace SavantTests\Template;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TChunk extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\Template\CChunk();
    }

    public function testTemplating()
    {
        $tplFile = \Savant\CBootstrap::$SKINS_DIR . \DIRECTORY_SEPARATOR .'test.html';
        $this->obj->setTemplate($tplFile);
        $this->assertEquals(true, strpos($this->obj->render(false),"@testvar@") !== false);
        $this->obj->testvar = 'Welt';
        $this->assertFalse(strpos($this->obj->render(false),"@testvar@"));
    }

    public function tearDown() {}
}