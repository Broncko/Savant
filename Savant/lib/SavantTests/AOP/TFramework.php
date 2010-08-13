<?php
namespace SavantTests\AOP;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TFramework extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\AOP\CFramework();
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    private function containsHelper($arr)
    {
        $this->assertContains('Savant\AOP\Aspects\AConfigure',$arr);
        $this->assertContains('Savant\AOP\Aspects\ALogging',$arr);
    }

    public function testGetAspectsFromFolder()
    {
        $aspects = \Savant\AOP\CFramework::getAspectsFromFolder();
        $this->containsHelper($aspects);
        return $aspects;
    }

    /**
     * @depends testGetAspectsFromFolder
     */
    public function testRegisterAspects()
    {
        $this->obj->registerAspects();
        foreach($this->obj->getPointCuts() as $pointcut)
        {
            $aspects[] = $pointcut->aspectClass;
        }
        $this->containsHelper($aspects);
    }
}