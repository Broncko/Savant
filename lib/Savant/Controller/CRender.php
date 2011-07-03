<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Controller
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Controller;

/**
 * @package Savant
 * @subpackage Controller
 * exception handling of CRender
 */
class ERender extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Controller
 * provides a renderer to handle url parameters and build a template out of the
 * dataset data
 */
class CRender extends \Savant\AStandardObject
{
    /**
     * url parts
     * @var array
     */
    private $urlParts = array();

    /**
     * class
     * @var string
     */
    private $class;

    /**
     * method
     * @var string
     */
    private $method;

    /**
     * connection
     * @var string
     */
    private $connection;

    /**
     * template
     * @var string
     */
    private $template;

    /**
     * mode
     * @var string
     */
    private $mode;

    /**
     * dataset data
     * @var \Savant\Storage\DataSet\CDataSet
     */
    private $dataset;

    /**
     * create renderer instance
     * @param array $pParams
     */
    public function __construct($pParams = array())
    {
        parent::__construct();
        if(count($pParams) > 0)
        {
            $this->urlParts = $pParams;
        }
    }

    /**
     * return meta information of query method
     * @return array
     */
    private function getMetaInformation()
    {
        $method = 'meta__query'.$this->method;
        if(\method_exists($this->class, $method))
        {
            return \Savant\AGenericCallInterface::call($this->class, $method);
        }
        else
        {
            return false;
        }
    }

    /**
     * parse request parameters
     * @param array $pParams
     */
    private function parseParams($pParams)
    {
        if(!\array_key_exists('class', $this->urlParts))
        {
            throw new ERender("class parameter is not set");
        }
        $this->class = $this->urlParts['class'];
        $this->query = $this->getUrlParam('query', 'Default');
        $this->connection = $this->getUrlParam('con', 'default');
        $this->template = $this->getUrlParam('tpl',$this->class);
        $this->mode = $this->getUrlParam('mode', \Savant\Template\CTwig::SUFFIX);
    }

    /**
     * add url parameter
     * @param string $pName
     * @param string $pParam
     */
    public function addUrlParam($pName, $pParam)
    {
        $this->urlParts[$pName] = $pParam;
    }

    /**
     * get url parameter
     * @param string $pParam
     * @param string $pDefault
     * @return string
     */
    public function getUrlParam($pParam, $pDefault = '')
    {
        return (\array_key_exists($pParam, $this->urlParts) ? $this->urlParts[$pParam] : $pDefault);
    }

    /**
     * handle renderer requests
     */
    public function _handle()
    {
        $dsp = new $this->class(new \Savant\Storage\CDatabase($this->connection));
        $this->dataSet = $dsp->dsQuery($this->query);
        $metaInfo = $this->getMetaInformation();
        $tplEngine = new \Savant\Template\CTwig();
        $tplEngine->setTemplate(\Savant\CBootstrap::$SKINS_DIR.\DIRECTORY_SEPARATOR.'dataset'.\Savant\Template\CTwig::SUFFIX);
        $tplEngine->title = $metaInfo->label;
        $tplEngine->assign($this->dataSet);
        $tplEngine->render();
    }

    /**
     * create renderer instance and handle requests
     */
    public static function create($pRequest)
    {
        $instance = new self($pRequest);
        $instance->handle();
    }
}