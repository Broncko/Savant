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
namespace \Savant\Utils\Benchmark;

/**
 * @package Benchmark
 * exception handling of CProfiler
 */
class EProfiler extends \Savant\EException {};

/**
 * @package Benchmark
 * provides profiling functionality, extending timer
 */
class CProfiler extends CTimer
{
    /**
     * holds sections
     * @var array $sections
     */
    protected $sections = array();

    /**
     * stack
     * @var SplStack $stack
     */
    protected $stack = null;

    /**
     * create profiler instance
     * @param boolean $pAutostart set to true if profiler should start timer
     */
    public function  __construct($pAutostart = false) {
        parent::__construct($pAutostart);
        $this->stack = new SplStack();
    }

    /**
     * is called when profiler is destroyed
     */
    public function  __destruct() {
        parent::__destruct();
    }

    /**
     * enter code section
     * @param string $pNote set note to mark section
     * @param array $options set section options
     */
    public function enterSection($pNote = '', $options = array())
    {
        $this->sections[$pNote] = $options;
        $this->lap($pNote);
    }

    /**
     * leave code section
     * @param string $pNote get section marked with note
     * @param array $options
     */
    public function leaveSection($pNote = '', $options = array())
    {
        $this->lap($pNote);
    }

    public function getSummary()
    {
        
    }
}
