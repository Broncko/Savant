<?php
/**
 * Savant Framework / Module Tests (Unit Tests)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    SavantTests
 * @subpackage Benchmark
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace SavantTests\Utils\Benchmark;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TTimer extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\Utils\Benchmark\CTimer();
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testTimer()
    {
        $this->obj->start();
        for($i = 1; $i <= 1200; $i++)
        {
            $calcTrash = md5(date('Y.m.d H:i'));
        }
        $this->obj->stop();
        $this->assertType('float',$this->obj->timeElapsed());
    }

    public function testLaps()
    {
        $this->obj->start();
        for($i = 1; $i <= 1800; $i++)
        {
            $calcTrash = md5(date('Y.m.d H:i'));
            if($i % 200 == 0)
            {
                $this->obj->lap('iter '.$i);
            }
        }
        $this->obj->stop();
        $lapArr = $this->obj->getLaps();
        $this->assertArrayHasKey('iter 200',$lapArr);
        $this->assertArrayHasKey('iter 1800',$lapArr);
    }
}
