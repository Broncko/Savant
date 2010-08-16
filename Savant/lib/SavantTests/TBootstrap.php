<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TBootstrap extends \Savant\ATestCase
{
    public function testLog()
    {
        \Savant\CBootstrap::log("Dies ist eine Testzeile");
    }
}