<?php
namespace Savant\Storage;

class EMySqlPdo extends \Savant\EException {}

class CMySqlPdo extends ADatabase implements IStorage
{
    private $pdo = null;

    public function __construct()
    {
        $this->dbo = new \PDO($this->DSN, $this->USERNAME, $this->PASSWORD);
    }

    public function store(IStorageObject $pObj)
    {

    }

    public function delete(IStorageObject $pObj)
    {

    }
}