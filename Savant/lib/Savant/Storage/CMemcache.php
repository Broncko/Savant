<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Storage
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage;

/**
 * @package Storage
 * exception handler of CMemcache
 */
class EMemcache extends \Savant\EException {}

/**
 * @package Storage
 * provides memcache class to store object in
 */
class CMemcache extends \Savant\AStandardObject implements \Savant\IConfigure, \Savant\IConnection
{
    /**
     * memcache server array
     * @var array $SERVER
     */
    public $SERVER = array();

    /**
     * memcache object
     * @var Memcache
     */
    private $mc = null;

    /**
     * create memcache instance
     */
    public function __construct()
    {
        $this->mc = new \Memcache();
    }

    /**
     * conntect to memcache server
     */
    public function connect()
    {
        foreach ($this->SERVER as $server) {
            $this->mc->addserver($server->host, $server->port, $server->persistent, $server->weight);
        }
    }

    /**
     * store object in memcache
     * @param string $pKey
     * @param mixed $pObj
     */
    public function __set($pKey, $pObj)
    {
        $this->mc->add($pKey, $pObj);
    }

    /**
     * get object from memcache
     * @param string $pKey
     * @return mixed
     */
    public function __get($pKey)
    {
        return $this->mc->get($pKey);
    }

    /**
     * close memcache connection
     */
    public function disconnect()
    {
        $this->mc->close();
    }

    /**
     * close connection when object will be destroyed
     */
    public function __destruct()
    {
        $this->disconnect();
    }


}