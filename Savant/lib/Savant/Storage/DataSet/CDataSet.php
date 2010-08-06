<?php
namespace Savant\Storage\DataSet;

class EDataSet extends \Savant\EException {}

class CDataSet implements \IteratorAggregate, \Countable
{
    public $data = null;

    public function __construct()
    {
        $this->data = new \SplObjectStorage();
    }

    public function count()
    {
        return count($this->data);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    public function assign($pData)
    {
        $this->data = $pData;
    }

    public function addRow($pData)
    {
        $this->data->attach($pData);
    }
}