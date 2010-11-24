<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Protocol
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Protocol;

/**
 * @package Savant
 * @subpackage Protocol
 * exception handling of CJson
 */
class EJson extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Protocol
 * provides json encoding and decoding
 */
class CJson
{
    /**
     * encode data to json
     * @param mixed $pObj
     * @return string
     */
    public static function encode($pObj)
    {
        return \json_encode($pObj);
    }

    /**
     * decode json data to native php datatypes
     * @param mixed $pObj
     * @return string
     */
    public static function decode($pObj)
    {
        return \json_decode($pObj);
    }
}