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

class EProfiler extends \Savant\EException {};

class CProfiler extends CTimer
{
    protected $sections = array();

    protected $stack = null;

    public function  __construct($pAutostart = false) {
        parent::__construct($pAutostart);
        $this->stack = new SplStack();
    }

    public function  __destruct() {
        parent::__destruct();
    }

    public function enterSection($pNote = '', $options = array())
    {
        $this->sections[$pNote] = $options;
        $this->lap($pNote);
    }

    public function leaveSection($pNote = '', $options = array())
    {
        $this->lap($pNote);
    }

    public function getSummary()
    {
        
    }
}
