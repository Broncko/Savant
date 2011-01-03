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
 * exception handling of CRequestResolver
 * @package Savant
 * @subpackage MVC
 */
class ERequestResolver extends \Savant\EException {}

/**
 * provides a request resolver
 * @package Savant
 * @subpackage MVC
 */
class CRequestResolver extends \Savant\AStandardObject
{
    /**
     * list of available request handler
     * @var \SplObjectStorage
     */
    private $requestHandler;

    /**
     * create request resolver instance
     */
    public function __construct()
    {
        parent::__construct();
        $this->requestHandler = new \SplObjectStorage();
    }

    /**
     * parse uri to extract request information
     * @param string $pUri
     * @return string
     */
    private static function parseUri($pUri)
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
     * build request from uri and method
     * @param string $pUri
     * @param string $pMethod
     * @return \Savant\MVC\CRequest
     */
    public function build()
    {
        $environment = \Savant\CBootstrap::getInstance('Savant\Utils\CEnvironment');
        $request = new CRequest();
        $request->setEnvironment($environment);
        return $request;
    }

    /**
     * decides which request handler to choose
     * @param Request $pRequest
     * @return \Savant\MVC\IRequestHandler
     */
    public function resolveHandler(CRequest $pRequest)
    {
        $workingRequestHandler = array();
        foreach($this->requestHandler as $requestHandler)
        {
            if($requestHandler->checkRequest($pRequest) !== false)
            {
                $priority = $requestHandler->getPriority();
                if(isset($workingRequestHandler[$priority]))
                {
                    throw new ERequestResolver("There is almost one request handler registered with the same priority");
                }
                $workingRequestHandler[$priority] = $requestHandler;
            }
        }
        \ksort($workingRequestHandler);
        return \array_pop($workingRequestHandler);
    }

    /**
     * register new request handler
     * @param IRequestHandler $pRequestHandler
     */
    public function registerRequestHandler(IRequestHandler $pRequestHandler)
    {
        $this->requestHandler->attach($pRequestHandler);
    }
}