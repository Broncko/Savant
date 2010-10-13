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
 * exception handling of CContext
 */
class EContext extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Security
 * provides security context
 */
class CContext extends \Savant\AStandardObject implements \Savant\IConfigure
{
    /**
     * security modules
     * @var array
     */
    public $MODULES = array();

    /**
     * shared state storage
     * @var object
     */
    public $sharedState = null;

    /**
     * security module instances
     * @var array
     */
    private $moduleInstances = null;

    /**
     * security subject
     * @var Savant\Security\CSubject
     */
    private $subject = null;

    /**
     * create security context instance
     * @param CSubject $pSubject
     */
    public function __construct(CSubject $pSubject = null)
    {
        parent::__construct();
        $this->sharedState = new stdClass();
        if(isset($pSubject))
        {
            $this->subject = $pSubject;
        }
        else
        {
            $this->subject = CSubject::create();
        }
        $this->moduleInstances = new SplObjectStorage();
    }

    /**
     * kill security context
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * create static instance of security context
     * @param CSubject $pSubject
     * @return self
     */
    public static function create(CSubject $pSubject = null)
    {
        return new self($pSubject);
    }

    /**
     * login with given credentials
     * @param array $pCredentials
     */
    public function login($pCredentials)
    {
        
    }
}