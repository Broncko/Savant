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
    public $name = '';

    public $label = '';

    public $description = '';

    public $params;

    public function __construct($pName = '', $pLabel = '', $pDescription = '')
    {
        $this->name = $pName;
        $this->label = $pLabel;
        $this->description=$pDescription;
        $this->params = new \SplObjectStorage();
    }

    public function addParam(\Savant\Storage\CParameter $pParam)
    {
        $this->params->attach($pParam);
    }

    public function removeParam(\Savant\Storage\CParameter $pParam)
    {
        $this->params->detach($pParam);
    }
}