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
namespace Savant\MVC;

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
class CRequest extends \Savant\AStandardObject
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
    public $method;

    /**
     * request format
     * @var string
     */
    public $format;

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
}