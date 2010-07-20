<?php
/**
 * Savant Framework / Module Tests (Unit Tests)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    SavantTests
 * @subpackage SavantTests
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace SavantTests;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TTestSuite extends \Savant\ATestCase
{
    private $obj = null;

    public function setUp()
    {
        $this->obj = new \Savant\CTestSuite();
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testGetTests()
    {
        $this->obj->getTests();
    }

}