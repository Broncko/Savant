<?php
namespace Savant\Storage\Driver;

class EMySqlPdo extends \Savant\EException {}

class CMySqlPdo implements \Savant\IConfigure
{
    public $DSN = '';

    public function __construct($pConfig = 'default')
    {
        parent::__construct($pConfig);
        $this->dbh = new \PDO($this->DSN, $this->USERNAME, $this->PASSWORD);
    }

    public function store(IStorageObject $pObj)
    {

    }

    public function delete(IStorageObject $pObj)
    {

    }
}