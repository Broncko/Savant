<?php
namespace Savant;

require_once 'PHPUnit/Framework.php';

class ETestCase extends EException {}

abstract class ATestCase extends \PHPUNIT_Framework_TestCase implements ITestCase
{
    
    public function main()
    {
            $testClass = get_class($this);
            $suite = new PHPUnit_Framework_TestSuite($testClass);
            $suite->addTestSuite($testClass);

            $result = $runner->doRun($suite, $arguments);
    }

    public function setUp() {}

    public function tearDown() {}
	
}