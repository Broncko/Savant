<?php
namespace Savant\Utils;

class CEnvironment
{
    public $server;

    public function __construct()
    {
        $this->server = (object)$_SERVER;
        $_SERVER = array('_SERVER', 'do not use superglobals directly');
    }
}