<?php
namespace Savant\Storage\DataSet;

class EQuery extends \Savant\EException {}

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