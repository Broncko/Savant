<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage MVC
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\MVC\Web;

/**
 * exception handling of CRequest
 * @package Savant
 * @subpackage MVC
 */
class ERequest extends \Savant\EException {}

/**
 * generic request
 * @package Savant
 * @subpackage MVC
 */
class CRequest extends \Savant\AStandardObject implements \Savant\MVC\IRequest
{
    /**
     * request uri
     * @var string
     */
    public $uri;

    /**
     * request method
     * @var string
     */
    protected $method;

    /**
     * request format
     * @var string
     */
    protected $format;

    /**
     * extracted controller
     * @var string;
     */
    protected $controller;

    /**
     * extracted action
     * @var string
     */
    protected $action;

    /**
     * extracted application
     * @var string
     */
    protected $app;

    /**
     * request arguments
     * @var array
     */
    protected $arguments = array();

    /**
     * request environment
     * @var \Savant\Utils\CEnvironment
     */
    private $environment;

    /**
     * create request instance
     * @param string $pSection
     */
    public function __contruct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    /**
     * set request environment
     * @param \Savant\Utils\CEnvironment $pEnv
     */
    public function _setEnvironment(\Savant\Utils\CEnvironment $pEnv)
    {
        $this->environment = $pEnv;
        $this->setRequestInformationByEnvironment();
    }

    /**
     * set request information by environment
     */
    private function setRequestInformationByEnvironment()
    {
        list($this->uri, $this->format) = self::parseUri($this->environment->server->REQUEST_URI);
        $this->method = $this->environment->server->REQUEST_METHOD;
    }

    /**
     * parses uri by raw uri and format seperated by a dot
     * @param string $pUri
     * @return array of type [uri, format]
     */
    private static function parseUri($pUri)
    {
        if(\strpos($pUri, '.') !== false)
        {

            $uriparts = \explode('.', $pUri);
            $format = \array_pop($uriparts);
            $uri = $uriparts[0];
        }
        else
        {
            $uri = $pUri;
            $format = 'html';
        }
        return array($uri, $format);
    }

    /**
     * get extracted controller name
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * get extracted action name
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * get request method
     * @return string
     */
    public function getMethod()
    {
       return $this->method;
    }

    /**
     * get request format
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * get extracted application
     * @return string
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * get request arguments
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * check if argument exists
     * @param string $pArgument
     * @return mixed
     */
    public function argumentExists($pArgument)
    {
        if(\key_exists($pArgument, $this->arguments))
        {
            return true;
        }
        return false;
    }
}