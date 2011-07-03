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
        $testObj = new \stdClass();
        $testObj->name = 'Hendrik Heinemann';
        $this->obj->hendrik = $testObj;
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testRender()
    {
        $this->obj->setTemplate('test'.\Savant\Template\CTwig::SUFFIX);
        $varsFound = function($tpl) {
            return (\strpos($tpl, '{{testvar}}') !== false);
        };
        $this->assertTrue($varsFound(\file_get_contents(\Savant\CBootstrap::$SKINS_DIR.\DIRECTORY_SEPARATOR.'test'.\Savant\Template\CTwig::SUFFIX)));
        $res = $this->obj->render();
        $this->assertFalse($varsFound($res));
    }
}