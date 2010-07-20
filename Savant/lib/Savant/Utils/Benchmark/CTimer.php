<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Benchmark
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils\Benchmark;

class ETimer extends \Savant\EException {}

class CTimer
{
    const STARTNOTE = 'start';

    const STOPNOTE = 'stop';

    protected $times = array();

    private $started = false;

    public function __construct($pAutostart = false)
    {
        if($pAutostart)
        {
            $this->start();
        }
    }

    private function getDifference($pFirstIndex = self::STARTNOTE, $pLastIndex = self::STOPNOTE)
    {
        return $this->times[$pLastIndex] - $this->times[$pFirstIndex];
    }

    public function lap($pNote = '')
    {
        $this->times[$pNote] = microtime(true);
    }

    public function start()
    {
        if($this->started != true)
        {
            $this->lap(self::STARTNOTE);
            $this->started = true;
        }
    }

    public function stop()
    {
        if($this->started != false)
        {
            $this->lap(self::STOPNOTE);
            $this->started = false;
        }
    }

    public function timeElapsed($pFirstNode = self::STARTNOTE, $pLastNode = self::STOPNOTE)
    {
        return $this->getDifference($pFirstNode, $pLastNode);
    }

    public function getLaps()
    {
        if(count($this->times) < 3)
        {
            return $this->timeElapsed();
        }
        $tmpTime = self::STARTNOTE;
        $diffs = array();
        foreach($this->times as $note => $curTime)
        {
            if($note == self::STARTNOTE)
            {
                continue;
            }
            $diffs[$note] = $this->getDifference($tmpTime, $note);
            $tmpTime = $note;
        }

        return $diffs;
    }
}
