<?php
namespace Savant\Storage;

class ADatabase extends \Savant\AStandardObject implements \Savant\IConfigure, \Savant\IConnection
{
    public $DSN = '';

    public $USERNAME = '';

    public $PASSWORD = '';

    public function connect() {}

    public function disconnect() {}
}