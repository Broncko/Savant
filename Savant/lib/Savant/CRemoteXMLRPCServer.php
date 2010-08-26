<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;

/**
 * @package Savant
 * exception handling of CRemoteXMLRPCServer
 */
class ERemoteXMLRPCServer extends EException {}

/**
 * @package Savant
 * provides remote procedure class server
 */
class CRemoteXMLRPCServer extends Webservice\AXMLRPCServer
{
    /**
     * create remote xmlrpc server instance
     */
    public function __construct()
    {
        parent::__construct();
        $this->registerMethod('call');
    }

    /**
     * destroy remote xmlrpc server instance
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * invoke generic call interface to handle call
     * @param string $pClass
     * @param string $pMethod
     * @param array $pArgs
     * @return mixed
     */
    public function call($pClass, $pMethod = 'main', $pArgs = array())
    {
        return \base64_encode(\serialize(AGenericCallInterface::call($pClass, $pMethod, $pArgs)));
    }

    /**
     * create remote server object
     * @return Savant\CRemoteXMLRPCServer
     */
    public function create()
    {
        return new self;
    }
}