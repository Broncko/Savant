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
 * exception handler of CDataSet
 */
class EDataSet extends \Savant\EException {}

/**
 * @package Storage
 * @subpackage DataSet
 * provides dataset object which holds data from several sources
 */
class CDataSet implements \IteratorAggregate, \Countable
{
    /**
     * Datasafe
     * @var SplObjectStorage $data
     */
    private $data = null;

    /**
     * create dataset instance
     */
    public function __construct($pData = null)
    {
        $this->data = new \SplObjectStorage();
        if($pData != null)
        {
            $this->assign($pData);
        }
    }

    /**
     * count items
     * @return integer
     */
    public function count()
    {
        return $this->data->count();
    }

    /**
     * provide iterator$pTemplate
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * assign data
     * @param mixed $pData
     */
    public function assign($pData)
    {
        switch(true)
        {
            case $pData instanceof \SplObjectStorage:
                $this->data->addAll($pData);
                break;
            case \is_array($pData):
                foreach($pData as $row)
                {
                    $this->data->attach((object)$row);
                }
                break;
        }
    }

    /**
     * add row to datasafe
     * @param mixed $pData
     */
    public function addRow($pData)
    {
        if(\is_array($pData))
        {
            $pData = (object)$pData;
        }
        $this->data->attach($pData);
    }

    /**
     * returns dataset data as array
     * @return array
     */
    public function getDataAsArray()
    {
        $res = array();
        foreach($this->data as $row)
        {
            $res[] = (array)$row;
        }
        return $res;
    }

    /**
     * get dataset field names
     * @return array
     */
    public function getFieldNames()
    {
        foreach($this->data as $row)
        {
            return \array_keys(\get_object_vars($row));
        }
    }
}