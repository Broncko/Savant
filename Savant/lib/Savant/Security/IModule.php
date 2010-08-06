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
namespace \Savant\Security;

interface IModule
{
    public function create(CSubject $pSubject, $pCallbackHandler = null);

    public function login($pCredentials);

    public function commit();

    public function abort();
}