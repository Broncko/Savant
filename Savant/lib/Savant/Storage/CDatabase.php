<?php
namespace Savant\Storage;

class CDatabase extends \Savant\AConnection implements \Savant\IConfigure, \Savant\IConnection
{
    public $USERNAME = '';

    public $PASSWORD = '';

    public $DRIVER = null;

    protected $dbh = null;

    public function __construct($pConfig = 'default')
    {
        parent::__construct($pConfig);
        echo "Hello World";
        //$this->dbh = new $this->DRIVER($pConfig);
    }

    public function connect() {}

    public function disconnect() {}
}