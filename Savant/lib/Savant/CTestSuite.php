<?php
namespace Savant;

class CTestSuite
{
    private $testClasses = null;

    public function __construct()
    {
        $this->testClasses = new \SplStack();
    }

    public static function getTests($pTestDir = AFramework::$TESTS_DIR)
    {
        $testDirArr = \scandir($pTestDir);
        foreach($testDirArr as $entry)
        {
            if($entry == '.' || $entry == '..')
            {
                continue;
            }
            if(\is_dir($entry))
            {
                self::getTests($entry);
            }
            if(\is_file($entry))
            {
                if(!\file_exists($entry))
                {
                    continue;
                }
                else
                {
                    
                }
            }
        }
    }
}

