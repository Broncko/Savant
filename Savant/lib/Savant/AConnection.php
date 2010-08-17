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
 * exception handling if AConnection
 */
class EConnection extends EException{}

/**
 * @package Savant
 * abstracts a connection to whatever
 */
abstract class AConnection extends AStandardObject implements IConfigure, IConnection 
{
    /**
     * host
     * @var string
     */
    public $HOST = '';

    /**
     * port
     * @var integer
     */
    public $PORT = 0;

    /**
     * connection
     * @var mixed
     */
    private $connection = null;

    /**
     * create connection instance
     * @param string $pConfig
     */
    public function __construct($pConfig = 'default')
    {
            parent::__construct($pConfig);
    }

    /**
     * establish the connection
     */
    public function connect()
    {

    }

    /**
     * kill the connection
     */
    public function disconnect()
    {

    }

    /**
     * check if connection already exists
     * @return boolean
     */
    public function isConnected()
    {
        return ($this->isConnected() != null);
    }
}