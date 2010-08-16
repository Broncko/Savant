<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage;

/**
 * @package Storage
 * exception handler of CDatabase
 */
class EDatabase extends \Savant\EException {}

/**
 * @package Storage
 * provides abstract connection to a database
 */
class CDatabase extends \Savant\AConnection implements \Savant\IConfigure, \Savant\IConnection
{
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
     * connection driver class
     * @var driver $DRIVER
     */
    public $DRIVER = null;

    /**
     * database handler
     * @var mixed $dbh
     */
    protected $dbh = null;

    /**
     * config section
     * @param string $pConfig
     */
    public function __construct($pConfig = 'default')
    {
        parent::__construct($pConfig);
        echo "Hello World";
        //$this->dbh = new $this->DRIVER($pConfig);
    }

    public function connect() {}

    public function disconnect() {}
}