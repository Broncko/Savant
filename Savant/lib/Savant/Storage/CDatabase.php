<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
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
 * provides abstract connection to a database
 */
class CDatabase extends \Savant\AConnection implements \Savant\IConfigure, \Savant\IConnection
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
    public $DRIVER = '';

    /**
     * database handler
     * @var PDO $dbh
     */
    public $dbh = null;

    /**
     * connection driver class
     * @var Savant\Storage\Driver\IDriver
     */
    public $driver = null;

    /**
     * create database instance
     * @param string $pConfig config section
     */
    public function __construct($pConfig = 'default')
    {
        parent::__construct($pSection);
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
    public function connect($pConn = 'default')
    {
        if(!$this->isConnected())
        {
            try
            {
                $this->driver->connect($this);
                \Savant\CBootstrap::log("connect to %s as %s",$this->DSN,$this->USERNAME);
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
    public function disconnect()
    {
        if(!$this->isConnected())
        {
            return;
        }
        $this->driver->disconnect($this);
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
     * execute sql query with result set
     * @param string $pSql
     */
    public function query($pSql)
    {
        if(!$this->isConnected())
        {
            throw new EDatabase("this method requires a database connection");
        }
        $this->dbh->query($pSql);
    }

    /**
     * execute sql query without result set
     * @param string $pSql
     */
    public function exec($pSql)
    {
        if(!$this->isConnected())
        {
            throw new EDatabase("this method requires a database connection");
        }
        $this->dbh->exec($pSql);
    }
}