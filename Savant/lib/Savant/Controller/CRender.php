<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
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
class CRender extends \Savant\Template\AEngine
{
    /**
     * url parts
     * @var array
     */
    private $urlParts = array();

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
        if(!\array_key_exists('class', $this->urlParts))
        {
            throw new ERender("class parameter is not set");
        }
        $class = $this->urlParts['class'];
        $query = $this->getUrlParam('query', 'Default');
        $connection = $this->getUrlParam('con', 'default');
        $template = $this->getUrlParam('tpl',$class);
        $mode = $this->getUrlParam('mode', \Savant\Template\CTwig::SUFFIX);
        $dsp = new $class(new \Savant\Storage\CDatabase($connection));
        $dataSet = $dsp->dsQuery($query);
        /*print_r(\Savant\CBootstrap::getClassesWithInterface('Savant\Template\IEngine'));
        foreach (\Savant\CBootstrap::getClassesWithInterface('Savant\Template\IEngine') as $engine)
        {
            if('.'.$mode.'.html' == $engine::SUFFIX)
            {
                $tplEngine = new $engine();
            }
        }*/
        $tplEngine = new \Savant\Template\CTwig();
        $tplEngine->setTemplate(\Savant\CBootstrap::$SKINS_DIR.\DIRECTORY_SEPARATOR.'dataset'.\Savant\Template\CTwig::SUFFIX);
        $tplEngine->assign($dataSet);
        $tplEngine->render();
    }

    /**
     * create renderer instance and handle requests
     */
    public static function create()
    {
        $instance = new self($_GET);
        $instance->handle();
    }
}