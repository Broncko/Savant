<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Security
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Security;

class ESubject extends \Savant\EException {}

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
        return $instance;
    }

    public function addPrincipal($principal)
    {
        $this->principals[$principal] = $principal;
    }

    public function removePrincipal($principal)
    {
        unset($this->principals[$principal]);
    }

    public function getPrincipals()
    {
        return $this->principals;
    }

    
}