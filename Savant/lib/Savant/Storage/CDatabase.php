<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package i$thisn the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Storage
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage;

/**
 * @package Savant
 * @subpackage Storage
 * exception handler of CDatabase
 */
class EDatabase extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Storage
 * provides connection to a database based on php data objects(PDO)
 */
class CDatabase extends \Savant\AConnection implements \Savant\IConfigure, \Savant\IConnection
{
    /**
     * database
     * @var string
     */
    public $DATABASE = '';

    /**
     * connection username credential
     * @var string $USERNAME
     */
    public $USERNAME = '';

    /**
     * connection password credential
     * @var string $PASSWORD
     */
    public $PASSWORD = '';

    /**
     * data source name
     * @var string
     */
    public $DSN = '';

    /**
     * database driver class
     * @var string
     */
    public $DRIVER_CLASS = '';

    /**
     * create database instance
     * @param string $pConfig config section
     */
    public function __construct($pSection = 'default', $pAutoconnect = true)
    {
        parent::__construct($pSection);
        if($pAutoconnect == true)
        {
            $this->connect();
        }
    }

    /**
     * kill database object
     */
    public function __destruct()
    {
        $this->disconnect();
        parent::__destruct();
    }

    /**
     * connect to defined database driver
     * @param string $pConn
     */
    public function _connect()
    {
        if(!$this->isConnected())
        {
            try
            {
                $this->con = \Savant\AGenericCallInterface::call((string)$this->DRIVER_CLASS, 'connect', array($this));
                \Savant\CBootstrap::log("connect to %s as %s",$this->confSection,$this->USERNAME);
            }
            catch(EDatabase $e)
            {
                throw $e;
            }
        }
        else
        {
            return;
        }
    }

    /**
     * kill database connection
     */
    public function _disconnect()
    {
        if(!$this->isConnected())
        {
            return;
        }
        //\Savant\AGenericCallInterface::call($this->DRIVER_CLASS, 'disconnect', array($this));
    }

    /**
     * set connection properties
     * @param string $pConn
     */
    public function setConnection($pConn = 'default')
    {
        \Savant\CConfigure::configure($this, $pConn);
    }

    /**
     * check if connection is set
     * @return boolean
     */
    public function connectionIsSet()
    {
        return $this->config instanceof \SimpleXMLElement;
    }

    /**
     * execute sql query with result set
     * @param string $pSql
     */
    public function _query($pSql, $pSection = 'default')
    {
        if(!$this->isConnected())
        {
            if(!$this->connectionIsSet())
            {
                $this->setConnection($pSection);
            }
            $this->connect();
        }
        return $this->con->query($pSql);
    }

    /**
     * execute sql query without result set
     * @param string $pSql
     */
    public function _exec($pSql)
    {
        if(!$this->isConnected())
        {
            throw new EDatabase("this method requires a database connection");
        }
        $this->con->exec($pSql);
    }
}