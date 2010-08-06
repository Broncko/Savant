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

/**
 * @package Benchmark
 * exception handler of CTimer
 */
class ETimer extends \Savant\EException {}

/**
 * @package Benchmark
 * provides timer to count time difference between start- and endpoints in codes
 */
class CTimer
{
    /**
     * define startnote
     * @var string STARTNOTE
     */
    const STARTNOTE = 'start';

    /**
     * define stopnote
     * @var string STOPNOTE
     */
    const STOPNOTE = 'stop';

    /**
     * array to store times
     * @var string $times
     */
    protected $times = array();

    /**
     * defines if timer has been started
     * @var boolean $started
     */
    private $started = false;

    /**
     * create timer instance
     * @param boolean $pAutostart set to true if timer should start when instantiated
     */
    public function __construct($pAutostart = false)
    {
        if($pAutostart)
        {
            $this->start();
        }
    }

    /**
     * return duration between two notes
     * @param string $pFirstIndex
     * @param string $pLastIndex
     * @return float
     */
    private function getDifference($pFirstIndex = self::STARTNOTE, $pLastIndex = self::STOPNOTE)
    {
        return $this->times[$pLastIndex] - $this->times[$pFirstIndex];
    }

    /**
     * define timepoint between start- and endpoint
     * @param string $pNote set note to recognize lap-point
     */
    public function lap($pNote = '')
    {
        $this->times[$pNote] = microtime(true);
    }

    /**
     * start timer
     */
    public function start()
    {
        if($this->started != true)
        {
            $this->lap(self::STARTNOTE);
            $this->started = true;
        }
    }

    /**
     * stop timer
     */
    public function stop()
    {
        if($this->started != false)
        {
            $this->lap(self::STOPNOTE);
            $this->started = false;
        }
    }

    /**
     * return start-stop duration (public alias of getDifference)
     * @param string $pFirstNode
     * @param string $pLastNode
     * @return float
     */
    public function timeElapsed($pFirstNode = self::STARTNOTE, $pLastNode = self::STOPNOTE)
    {
        return $this->getDifference($pFirstNode, $pLastNode);
    }

    /**
     * returns array of differences between stored laps
     * @return array
     */
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
