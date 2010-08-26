<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Protocol
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Webservice;

/**
 * @package Savant
 * @subpackage Protocol
 * exception handling of AXMLRPCServer
 */
class EXMLRPCServer extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Protocol
 * provides an abstract xmlrpc server that every concrete xmlrpc server can
 * be derived from.
 */
abstract class AXMLRPCServer
{
    /**
     * php5's build in xmlrpc functions
     * @var xmlrpc_server
     */
    protected $server;

    /**
     * create xmlrpc server instance
     */
    public function __construct()
    {
        $this->server = \xmlrpc_server_create();
    }

    /**
     * destroy xmlrpc server instance
     */
    public function __destruct()
    {
        \xmlrpc_server_destroy($this->server);
    }

    /**
     * register a method
     * @param string $pMethod
     * @param string $pCallback
     */
    public function registerMethod($pMethod, $pCallback = null)
    {
        if(!isset($pCallback))
        {
            $pCallback = array(&$this, $pMethod);
        }
        if(!\is_callable($pCallback))
        {
            throw new EXMLRPCServer("method %s is not callable",$pMethod);
        }
        \xmlrpc_server_register_method($this->server, $pMethod, $pCallback);
    }

    /**
     * handle request
     * @param string $pData optional, data from standard input will be used as
     * default
     * @param boolean $displayReponse
     * @return mixed
     */
    public function handle($pData = null, $displayReponse = true)
    {
        if(\is_null($pData))
        {
            $pData = \Savant\Protocol\AHttp::getPostData();
        }
        if(empty($pData))
        {
            throw new EXMLRPCServer("invalid xml rpc call without data");
        }

        $response = \xmlrpc_server_call_method($this->server, $data, '');

        if($displayReponse)
        {
            print $response;
        }

        return $response;
    }
}
