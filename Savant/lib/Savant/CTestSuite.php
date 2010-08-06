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
require_once '/home/broncko/Documents/projects/Savant/savant.php';
require_once 'PHPUnit/Framework.php';

/**
 * Provides a testsuite to run all tests which extend the AAutotestCase class
 */
class CTestSuite extends \PHPUnit_Framework_TestSuite
{
    /**
     * Tests namespace
     * @var string
     */
    const NS_TESTS = 'SavantTests';

    /**
     * testsuite name
     * @var string
     */
    const NAME = 'Savant';

    /**
     * testclasses path
     * @var string
     */
    public $PATH = '';

    /**
     * returns testclasses of specific subclass, if given
     * @param string $pSubclass
     * @return array
     */
    public static function getTests($pSubclass = '')
    {
        foreach(self::getTestFiles(AFramework::$TESTS_DIR) as $testFile)
        {
            $test = \str_replace(AFramework::$TESTS_DIR, '', $testFile[0]);
            $test = \str_replace(\DIRECTORY_SEPARATOR, '\\', $test);
            $test = self::NS_TESTS.\str_replace('.php', '', $test);
            if(!empty($pSubclass))
            {
                $rf = new \ReflectionClass($test);
                if(!$rf->isSubclassOf($pSubclass))
                {
                    continue;
                }
            }
            $tests[] = $test;
        }
        return $tests;
    }

    /**
     * returns list of testfiles
     * @param string $pPath
     * @return RegexIterator
     */
    public static function getTestFiles($pPath)
    {
        $Directory = new \RecursiveDirectoryIterator($pPath, \FilesystemIterator::SKIP_DOTS);
        $Iterator = new \RecursiveIteratorIterator($Directory);
        $Regex = new \RegexIterator($Iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);
        return $Regex;
    }

    /**
     * instantiates itself
     * @return CTestSuite
     */
    public static function suite()
    {
        $instance = new self(self::NAME);
        $testClasses = self::getTests('Savant\AAutoTestCase');
        foreach($testClasses as $testClass)
        {
            $instance->addTestSuite($testClass);
        }
        return $instance;
    }
}

