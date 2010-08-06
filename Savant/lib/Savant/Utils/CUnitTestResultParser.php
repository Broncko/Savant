<?php
namespace Savant\Utils;

class EUnitTestResultPaser extends \Savant\EException {}

class CUnitTestResultParser extends \Savant\AStandardObject implements \Savant\IConfigure
{
    public $TESTFILE = '';

    private $simplexml;

    public function __construct()
    {
        self::$_DTD_VALID = false;
        parent::__construct();
        $this->simplexml = \simplexml_load_file($this->TESTFILE);
    }

    public function parse(\SimpleXMLElement $pRoot = null)
    {
        $testSuiteInfos = $this->simplexml->testsuite->attributes();
        return $testSuiteInfos;
    }
}