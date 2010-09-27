<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Webservice
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Webservice;

/**
 * @package Savant
 * @subpackage Webservice
 * exception handling of xmlrpc client
 */
class EXMLRPCClient extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Webservice
 * provides an xmlrpc client based on php5's xmlrpc_* implementation
 */
class CXMLRPCCLient extends \Savant\AStandardObject implements \Savant\IConnection, \Savant\IConfigure
{
    /**
     * protocol type http
     */
    const PROTOCOL_TYPE_HTTP = 'http';

    /**
     * request url
     * @var string
     */
    public $URL = '';

    /**
     * protocol type
     * @var string
     */
    public $PROTOCOL_TYPE;

    /**
     * http request handler
     * @var Savant\Protocol\CHttp
     */
    private $httpHandler;

    /**
     * creates xmlrpc client instance and initiates http handler. the config
     * section parameter has to be defined in both config files:
     * - conf/Savant/Webservice/CXMLRPCClient.conf.xml
     * - conf/Savant/Protocol/CHttp.conf.xml
     * @param string $pSection
     */
    public function __construct($pSection = 'default')
    {
        \Savant\CBootstrap::extensionLoaded('xmlrpc');

        parent::__construct($pSection);
        $this->httpHandler = new \Savant\Protocol\CHttp($pSection);
    }

    /**
     * destroy xmlrpc client
     */
    public function __destruct()
    {
        $this->disconnect();
        parent::__destruct();
    }

    /**
     * establish connection
     */
    public function _connect() {}

    /**
     * disconnect
     */
    public function _disconnect() {}

    /**
     * execute xml remote procedure call
     * @param string $pMethod
     * @param array $pArgs
     * @return mixed
     */
    public function call($pMethod, $pArgs = array())
    {
        $request = \xmlrpc_encode_request($pMethod, $pArgs);
        
        $file = $this->httpHandler->send(array($request));
        
        $response = \xmlrpc_decode($file);
        
        return $response;
    }
}