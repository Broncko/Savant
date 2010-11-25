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
    const RSP_FORMAT_XHTML = 'xhtml';

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
        $uri = \parse_url($pUri);
        $uriParts = \explode('/',$uri['path']);
        \array_shift($uriParts);
        $res = array();
        $res['app'] = $uriParts[0];
        $res['controller'] = (!empty($uriParts[1]) ? $uriParts[1] : 'index');
        $res['action'] = (!empty($uriParts[2]) ? $uriParts[2] : 'index');
        if(isset($uri['query']))
        {
            foreach(\explode('&', $uri['query']) as $query)
            {
                list($key, $val) = \explode('=', $query);
                $res['options'][$key] = $val;
            }
        }
        return $res;
    }

    /**
     * handle requests
     * @param \Savant\Template\IEngine $pEngine
     * @param string $pUri
     */
    public static function handle($pUri = '')
    {
        $fcParts = self::parseUri($pUri);
        //print_r($fcParts);
        if(isset($fcParts['options']['fmt']) && $fcParts['options']['fmt'] != self::RSP_FORMAT_XHTML)
        {
            switch($fcParts['options']['fmt'])
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
            $engine = new \Savant\Template\CTwig();
        }
        
        $instance = new self($engine);

        $app = new \Savant\CApplication($fcParts['app']);

        $model = $app->getModel($fcParts['controller'], $fcParts['action']);

        $controller = $app->callController($model);

        $view = $app->view($instance->engine, $controller);

        $view->render();
    }
}