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

/**
 * @package Savant
 * @subpackage Security
 * exception handling of CSubject
 */
class ESubject extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Security
 * provides security subject
 */
class CSubject extends \Savant\AStandardObject
{
    /**
     * user principals
     * @var array
     */
    private $principals = array();

    /**
     * create security subject instance
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * kill security subject
     */
    public function __destruct()
    {
        parent::__construct();
    }

    /**
     * add principal to security subject
     * @param mixed $principal
     */
    public function addPrincipal($principal)
    {
        $this->principals[$principal] = $principal;
    }

    /**
     * remove principal from subject
     * @param mixed $principal
     */
    public function removePrincipal($principal)
    {
        unset($this->principals[$principal]);
    }

    /**
     * return subjects principals
     * @return array
     */
    public function getPrincipals()
    {
        return $this->principals;
    }

    
}