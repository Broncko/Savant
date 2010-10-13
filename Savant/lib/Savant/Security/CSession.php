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
 * exception handling of CSession
 */
class ESession extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Security
 * provides a security module based on session handling
 */
class CSession
{
    /**
     * session name
     * @var string
     */
    public static $NAME = 'SavantSCT';

    /**
     * set true if session is readonly
     * @var boolean
     */
    public static $READONLY = false;

    /**
     * session time to live
     * @var integer
     */
    public static $TTL = 900; // 15min

    /**
     * session variables prefix
     * @var string
     */
    public static $PREFIX = 'Savant_';

    /**
     * create instance of session handling class
     * @return integer
     */
    public function __construct()
    {
        self::destroy();
        \session_name(self::$NAME);
        \session_start();
        $_SESSION[self::$PREFIX . 'session_expire'] = time() + self::$TTL;
        return self::getId();
    }

    /**
     * return session id
     * @return integer
     */
    public static function getId()
    {
        return session_id();
    }

    /**
     * return session name
     * @return string
     */
    public static function getName()
    {
        return \session_name();
    }

    /**
     * destroy session
     */
    public static function destroy()
    {
        \session_write_close();
        unset($_SESSION);
        \session_destroy();
    }

    /**
     * resume a session
     * @param integer $pSid
     * @return integer
     */
    public function resume($pSid)
    {
        self::destroy();
        \session_name(self::$NAME);
        \session_id($pSid);
        \session_start();
        if(isset($_SESSION[self::$PREFIX . 'session_expire']) && ($_SESSION[self::$PREFIX . 'session_expire'] > time()))
        {
            $_SESSION[self::$PREFIX . 'session_expire'] = time() + self::$TTL;
            return $pSid;
        }
        else
        {
            self::destroy();
            return false;
        }
    }

    /**
     * set a session value
     * @param string $pKey
     * @param mixed $pValue
     */
    public function __set($pKey, $pValue)
    {
        $_SESSION[self::$PREFIX . $pKey] = $pValue;
    }

    /**
     * get a session value if exists otherwise true
     * @param string $pKey
     * @return mixed
     */
    public function __get($pKey)
    {
        if(isset($_SESSION[self::$PREFIX . $pKey]))
        {
            return $_SESSION[self::$PREFIX . $pKey];
        }
        else
        {
            return false;
        }
    }

    /**
     * destroy session and session handler
     */
    public function __destruct()
    {
        self::destroy();
    }
}