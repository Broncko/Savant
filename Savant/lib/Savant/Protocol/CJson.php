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

class EJson extends \Savant\EException {}

class CJson
{
    public static function encode($pObj)
    {
        return \json_encode($pObj);
    }

    public static function decode($pObj)
    {
        return \json_decode($pObj);
    }
}