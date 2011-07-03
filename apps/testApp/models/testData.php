<?php
namespace testApp\models;

class testData extends \Savant\Storage\ACrud
{
    const DEFAULT_DB = 'savant_mysql';

    public function __construct(\Savant\Storage\CDatabase $pDb)
    {
        parent::__construct($pDb);
        self::$TABLE = 'test';
    }
}