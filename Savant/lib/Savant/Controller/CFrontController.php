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
class CFrontController extends \Savant\AStandardObject implements \Savant\IConfigure
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
    private $module = '';

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
        $this->engine = $pEngine;
        /*$params = self::parseRequest();
        $tplFile = \Savant\CBootstrap::$SKINS_DIR .\DIRECTORY_SEPARATOR . $params->tpl . $pEngine::SUFFIX;
        $pEngine->setTemplate($tplFile);*/
    }

    /**
     * merge template with data
     * @param \Savant\Storage\DataSet\CDataSet $pData
     */
    public function merge(\Savant\Storage\DataSet\CDataSet $pData)
    {
        foreach($pData->data as $row)
        {
            foreach($row as $tplVar => $var)
            {
                $this->engine->{$tplVar} = $var;
            }
        }
    }

    /**
     * print template
     */
    public function out()
    {
        $this->engine->render();
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
    public function parseUri($pUri)
    {
        $uri = (object)\parse_url($pUri);
        $uriParts = \explode('/',  \str_replace($_SERVER['SCRIPT_NAME'], '',$uri->path));
        $this->controller = '\cms\controller\\'.$uriParts[1];
        $this->action = $uriParts[2];
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
        $action = (!empty($instance->action) ? $instance->action : 'index');
        $controller = \array_reverse(\explode('\\', $instance->controller));
        $res = \Savant\AGenericCallInterface::call($instance->controller, $action);

        //TODO: remove hardcoded template path
        $tplPath = \cms\Core::$VIEW_DIR.'/'.$controller[0].'/'.$action.'.chunk.html';

        //wrong place for setting template? perhaps do this at module code
        $instance->engine->setTemplate($tplPath);
        $instance->engine->assign($res);
        $instance->engine->render();
    }
}