<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;
require_once 'PHPUnit/Framework.php';

/**
 * @package Savant
 * exception handling of ATestCase
 */
class ETestCase extends EException {}

/**
 * @package Savant
 * provides a testcase extending from phpunit testcases
 */
abstract class ATestCase extends \PHPUNIT_Framework_TestCase implements ITestCase
{
    /**
     * returns testsuite
     * @return PHPUnit_Framework_TestSuite
     */
    public static function main()
    {
            $suite = new PHPUnit_Framework_TestSuite(\get_class($this));
            $suite->addTestSuite($testClass);
            return $suite;
    }

    /**
     * just a reminder, if you forget to define a setUp() method in the testcase
     */
    public function setUp()
    {
        echo "remember to define set up method\n";
    }

    /**
     * just a reminder, if you forget to define a tearDown() method in the testcase
     */
    public function tearDown()
    {
        echo "remember to define tear down method\n";
    }
	
}