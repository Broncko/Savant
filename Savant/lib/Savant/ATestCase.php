<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;
require_once 'PHPUnit/Framework.php';

class ETestCase extends EException {}

/**
 * provides a testcase extending from phpunit testcases
 * @abstract ATestCase
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

    public function setUp()
    {
        echo "remember to define set up method\n";
    }

    public function tearDown()
    {
        echo "remember to define tear down method\n";
    }
	
}