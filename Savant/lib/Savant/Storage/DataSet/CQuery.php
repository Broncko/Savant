<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage DataSet
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage\DataSet;

/**
 * @package Storage
 * @subpackage DataSet
 * exception handling of CQuery
 */
class EQuery extends \Savant\EException {}

/**
 * @package Storage
 * @subpackage DataSet
 * provides database query 
 */
class CQuery
{
    /**
     * query name
     * @var string
     */
    public $name = '';

    /**
     * query label meta information
     * @var string
     */
    public $label = '';

    /**
     * query description meta information
     * @var string
     */
    public $description = '';

    /**
     * query params
     * @var string
     */
    public $params = array();

    /**
     * create database query instance
     * @param string $pName
     * @param string $pLabel
     * @param string $pDescription
     */
    public function __construct($pName, $pLabel = '', $pDescription = '', $pParams = array())
    {
        $this->name = $pName;
        $this->label = $pLabel;
        $this->description=$pDescription;
        $this->params = $pParams;
    }

    /**
     * add query parameter
     * @param string $pName
     * @param \Savant\CParameter $pParam
     */
    public function addParam($pName, \Savant\CParameter $pParam)
    {
        $this->params[$pName] = $pParam;
    }

    /**
     * set query parameter, alias of addParam()
     * @param string $pKey
     * @param \Savant\CParameter $pValue
     */
    public function __set($pKey, \Savant\CParameter $pValue)
    {
        $this->addParam($pKey, $pValue);
    }
}