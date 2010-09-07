<?php
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TBootstrap extends \Savant\ATestCase
{
    /*public function testLog()
    {
        \Savant\CBootstrap::log("Dies ist eine Testzeile");
    }*/

    public function xtestGetClasses()
    {
        $classes = \Savant\CBootstrap::getClasses('Savant\AStandardObject');
        print_r($classes);
    }

    public function testGetClassesWithInterface()
    {
        $classes = \Savant\CBootstrap::getClassesWithInterface('Savant\IConfigure');
        print_r($classes);
    }
}