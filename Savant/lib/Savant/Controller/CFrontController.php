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
     * response format json
     * @var string
     */
    const RSP_FORMAT_JSON = 'json';

    /**
     * response format xml
     * @var string
     */
    const RSP_FORMAT_XML = 'xml';

    /**
     * response format xhtml
     * @var string
     */
    const RSP_FORMAT_XHTML = 'html';

    /**
     * response format image
     * @var string
     */
    const RSP_FORMAT_IMG = 'img';
    
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
     * mvc options
     * @var array
     */
    private $options = array();

    /**
     * create frontcontroller instance
     * @param \Savant\Template\IEngine $pEngine
     */
    public function __construct(\Savant\Template\IEngine $pEngine)
    {
        parent::__construct();
        $this->engine = $pEngine;
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
    public static function parseUri($pUri)
    {
        $res = array();
        $uri = \parse_url($pUri);
        if(\strpos($uri['path'], '.') !== false)
        {
            $path = \explode('.', $uri['path']);
            $res['format'] = \array_pop($path);
        }
        else
        {
            $path[0] = $uri['path'];
            $res['format'] = 'html';
        }
        $uriParts = \explode('/',$path[0]);
        \array_shift($uriParts);
        $uriHasParts = function($parts)
        {
            return (count($parts) > 0 ? true : false);
        };
        $res['app'] = \array_shift($uriParts);
        $res['controller'] = ($uriHasParts($uriParts) ? \array_shift($uriParts) : null);
        $res['action'] = ($uriHasParts($uriParts) ? \array_shift($uriParts) : null);
        if($uriHasParts($uriParts))
        {
            if(count($uriParts) > 1)
            {
                for($i = 0; $i < count($uriParts); $i+2)
                {
                    $res['data'][\array_shift($uriParts)] = \array_shift($uriParts);
                }
            }
            else
            {
                $res['data'] = \array_shift($uriParts);
            }
        }
        else
        {
            $res['data'] = null;
        }
        return $res;
    }

    /**
     * translating the payload
     * @return mixed
     */
    private static function getPayload()
    {
        if(isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0)
        {
            return \file_get_contents('php://input');
        }
        else
        {
            return false;
        }
    }

    /**
     * handle requests
     * @param \Savant\Template\IEngine $pEngine
     * @param string $pUri
     */
    public static function handle($pUri = '', $pRequestType = 'GET')
    {
        $fcParts = self::parseUri($pUri);

        $app = new \Savant\CApplication($fcParts);

        $model = $app->getModel($fcParts['controller'], $fcParts['action']);

        if(isset($fcParts['format']) && $fcParts['format'] != self::RSP_FORMAT_XHTML)
        {
            switch($fcParts['format'])
            {
                case self::RSP_FORMAT_JSON:
                    $engine = new \Savant\Template\CJson();
                    break;
                case self::RSP_FORMAT_IMG:
                    $engine = new \Savant\Template\CJpGraph();
                    break;
            }
        }
        else
        {
            $engine = new \Savant\Template\CTwig($app);
        }

        $instance = new self($engine);

        try
        {
            $res = $app->callController();
        }
        catch(\Savant\EApplication $e)
        {
            if($model instanceof \Savant\Webservice\IRestful)
            {
                switch($pRequestType)
                {
                    case 'GET':
                        if(!\is_null($fcParts['action']) && \method_exists($model, $fcParts['action']))
                        {
                            $res = \Savant\AGenericCallInterface::call($model, $fcParts['action']);
                        }
                        else
                        {
                            $res = $model->read($fcParts['data']);
                        }
                        break;
                    case 'PUT':
                        $postdata = self::getPayload();
                        if($postdata !== false)
                        {
                            new \Savant\EApplication("no data sent to work with");
                        }
                        $data["fields"] = (array)\Savant\Protocol\CJson::decode($postdata);
                        $data[":id"] = ($fcParts['action'] == 'index' ? null : $fcParts['action']);
                        $res = $model->update((array)$data);
                        break;
                    case 'POST':
                        $data = self::getPayload();
                        if($data !== false)
                        {
                            new \Savant\EApplication("no data sent to work with");
                        }
                        $data = \Savant\Protocol\CJson::decode($data);
                        $res = $model->create((array)$data);
                        break;
                    case 'DELETE':
                        $res = $model->delete($fcParts['data']);
                        break;
                    default:
                        $res = $app->callController($model);
                }
            }
        }

        $view = $app->view($instance->engine, $res);

        $view->render();
    }
}