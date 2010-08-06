<?php
namespace Savant\Template;

class ETemplateEngine extends \Savant\EException {}

class AEngine extends \Savant\AStandardObject implements \Savant\IConfigure
{
    public $TEMPLATE_DIR = '';

    public $COMPILE_DIR = '';

    protected $template = '';

    protected $data = null;

    public function __set($pKey, $pValue)
    {
        $this->data->{$pKey} = $pValue;
    }

    public function assign($obj)
    {
        $this->data = $obj;
    }
}