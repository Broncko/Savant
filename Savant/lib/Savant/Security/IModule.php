<?php
namespace \Savant\Security;

interface IModule
{
    public function create(CSubject $pSubject, $pCallbackHandler = null);

    public function login($pCredentials);

    public function commit();

    public function abort();
}