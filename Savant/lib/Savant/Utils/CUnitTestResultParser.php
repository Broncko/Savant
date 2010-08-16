<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils;

/**
 * @package Savant
 * @subpackage Utils
 * exception handling of CUnitTestResultParser
 */
class EUnitTestResultPaser extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Utils
 * parse results from the unit-testsuite and display them
 */
class CUnitTestResultParser extends \Savant\AStandardObject implements \Savant\IConfigure
{
    /**
     * conf value testfile
     * @var string
     */
    public $TESTFILE = '';

    /**
     * simplexml root element
     * @var SimpleXMLElement
     */
    private $simplexml;

    /**
     * create unit test result parser instance from testfile
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
        $this->simplexml = \simplexml_load_file($this->TESTFILE);
    }

    /**
     * parse testsuite results
     * @param \SimpleXMLElement $pRoot
     * @return mixed
     */
    public function parse(\SimpleXMLElement $pRoot = null)
    {
        $testSuiteInfos = $this->simplexml->testsuite->attributes();
        return $testSuiteInfos;
    }
}