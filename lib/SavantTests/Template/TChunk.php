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

    public function testAssignVar()
    {
        $testObj = new \stdClass();
        $testObj->name = 'Hendrik Heinemann';
        $this->obj->hendrik = $testObj;
    }

    public function xtestTemplating()
    {
        $tplFile = \Savant\CBootstrap::$SKINS_DIR . \DIRECTORY_SEPARATOR .'test'.\Savant\Template\CChunk::SUFFIX;
        $this->obj->setTemplate($tplFile);
        $this->assertTrue(strpos($this->obj->render(false),"{{testvar}}") !== false);
        $this->obj->testvar = 'Welt';
        $this->assertTrue(strpos($this->obj->render(false),"{{testvar}}") !== false);
    }

    public function tearDown() {}
}