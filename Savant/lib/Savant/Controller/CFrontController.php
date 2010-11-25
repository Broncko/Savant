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
 * @package    Savant
 * @subpackage Controller
 * Exception-handling for front controller
 *
 */
class EFrontController extends \Savant\EException {}


/**
 * @package    Savant
 * @subpackage Controller
 * provides front controller functionality
 * handles request from client and transforms it to needed data to proceed with the framework
 * 
 */
class CFrontController extends \Savant\AStandardObject
{
    /**
     * template engine
     * @var Savant\Template\IEngine
     */
    public $engine = null;

    /**
     * module
     * @var string
     */
    private $app = '';

    /**
     * mvc controller
     * @var string
     */
    private $controller = '';

    /**
     * mvc action
     * @var Savant\MVC\AAction
     */
    private $action = '';

    /**
     * create frontcontroller instance
     * @param \Savant\Template\IEngine $pEngine
     */
    public function __construct(\Savant\Template\IEngine $pEngine)
    {
        parent::__construct();
        $this->engine = $pEngine;
        /*$params = self::parseRequest();
        $tplFile = \Savant\CBootstrap::$SKINS_DIR .\DIRECTORY_SEPARATOR . $params->tpl . $pEngine::SUFFIX;
        $pEngine->setTemplate($tplFile);*/
    }

    /**
     * merge template with data
     * @param \Savant\Storage\DataSet\CDataSet $pData
     */
    public function _merge($pData)
    {
        $this->engine->assign($pData);
    }

    /**
     * print template
     */
    public function _out()
    {
        echo $this->engine->render();
    }

    /**
     * alias for out()
     */
    public function  __toString()
    {
        return $this->out();
    }

    /**
     * parse url request
     * @return object $_REQUEST as object
     */
    public static function parseRequest()
    {
        return (object)$_REQUEST;
    }

    /**
     * parse url
     * @param string $pUri
     */
    public function _parseUri($pUri)
    {
        $uriParts = \explode('/',  \str_replace($_SERVER['SCRIPT_NAME'], '',$pUri));
        \array_shift($uriParts);
        list($this->app, $this->controller, $this->action) = $uriParts;
    }

    /**
     * handle requests
     * @param \Savant\Template\IEngine $pEngine
     * @param string $pUri
     */
    public static function handle(\Savant\Template\IEngine $pEngine, $pUri)
    {
        $instance = new self($pEngine);
        $instance->parseUri($pUri);

        $app = new \Savant\CApplication($instance->app);

        $model = $app->getModel($instance->controller, $instance->action);

        $controller = $app->callController($model);

        $view = $app->view($instance->engine, $controller);
        
        $view->render();
    }
}