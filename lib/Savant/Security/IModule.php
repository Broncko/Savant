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
 * provides interface to implement security modules
 */
interface IModule
{
    /**
     * create security module
     */
    public function create(CSubject $pSubject, $pCallbackHandler = null);

    /**
     * login with given credentials
     */
    public function login($pCredentials);

    /**
     * commit changes
     */
    public function commit();

    /**
     * abort security module
     */
    public function abort();
}