<?php
namespace Savant\Security;

class CSubject extends \Savant\CStandardObject
{
    private $principals = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__construct();
    }

    public static function create()
    {
        $instance = new self();
    }

    public function addPrincipal($principal)
    {
        $this->principals[$principal] = $principal;
    }

    public function removePrincipal($principal)
    {
        unset($this->principals[$principal]);
    }


    
}