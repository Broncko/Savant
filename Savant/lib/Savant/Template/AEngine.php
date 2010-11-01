<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Template
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Template;

/**
 * @package Savant
 * @subpackage Template
 * provides exception handling of AEngine
 */
class ETemplateEngine extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Template
 * abstracts a template engine
 */
abstract class AEngine extends \Savant\AStandardObject implements \Savant\IConfigure
{
    /**
     * template directory
     * @var string
     */
    public $TEMPLATE_DIR = '';

    /**
     * folder to store compiled templates in
     * @var string
     */
    public $COMPILE_DIR = '';

    /**
     * the template itself
     * @var string
     */
    protected $template = '';

    /**
     * the data which is merged with the template
     * @var mixed
     */
    protected $data = null;

    /**
     * create template engine instance
     * @param string $pSection
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
        $this->TEMPLATE_DIR = \Savant\CBootstrap::$SKINS_DIR;
        $this->COMPILE_DIR = \Savant\CBootstrap::$CACHE_DIR;
    }

    /**
     * set data value
     * @param string $pKey
     * @param mixed $pValue
     */
    public function __set($pKey, $pValue)
    {
        $this->data[$pKey] = $pValue;
    }

    /**
     * get data value
     * @param string $pKey
     * @return mixed
     */
    public function __get($pKey)
    {
        return $this->data[$pKey];
    }

    /**
     * assign data
     * @param \Savant\Storage\DataSet\CDataSet $obj
     */
    public function _assign(\Savant\Storage\CValueObject $pValObj)
    {
        $this->data = $pValObj;
    }

    /**
     * set template
     * @param string $pTemplate
     */
    public function _setTemplate($pTemplate)
    {
        $this->template = $pTemplate;
    }
}