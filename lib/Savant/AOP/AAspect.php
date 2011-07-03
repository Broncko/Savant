<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

namespace Savant\AOP;

/**
 * @package    Savant
 * @subpackage AOP
 * Exception-handling for Aspects
 *
 */
class EAspect extends \Savant\EException {}

/**
 * @package    Savant
 * @subpackage AOP
 * Holds basic informations of aspects 
 */
abstract class AAspect
{
    /**
     * returns joinpointmask
     * @return array
     */
    public static function getJoinPointMask()
    {
        return AFramework::getJoinPointsFromFolder();
    }
}