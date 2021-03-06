<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;

/**
 * @package Savant
 * exception handling of AGenericCallInterface
 */
class EGenericCallInterface extends EException {}

/**
 * @package Savant
 * @abstract AGenericCallInterface
 * provides generic call interface for the platform
 */
abstract class AGenericCallInterface
{
    /**
     * static call mode
     * @var MODE_STATIC
     */
    const MODE_STATIC = 'static';

    /**
     * instantiate object before call method
     * @var MODE_OBJECT
     */
    const MODE_OBJECT = 'object';

    /**
     * option mode
     * @var OPT_MODE
     */
    const OPT_MODE = 'mode';

    /**
     * execute given classmethod and return result
     * @param string $pClass class to invoke
     * @param string $pMethod method to execute
     * @param array $pArgs method arguments
     * @param array $pOpts call options
     */
    public static function call($pClass, $pMethod = '__construct', $pArgs = array(), $pOpts = array())
    {
        if(!\is_object($pClass))
            {
            if(!\class_exists($pClass))
            {
                throw new EGenericCallInterface('class %s does not exist', $pClass);
            }
            if(!\method_exists($pClass, $pMethod))
            {
                throw new EGenericCallInterface('method %s::%s does not exist', $pClass, $pMethod);
            }
        }
        $mode = (!empty($pOpts['mode']) ? $pOpts['mode'] : self::getCallMode($pClass, $pMethod));
        try
        {
            switch($mode)
            {
                case self::MODE_STATIC:
                    $res = \call_user_func_array(array($pClass, $pMethod), $pArgs);
                    break;
                case self::MODE_OBJECT:
                    $obj = new $pClass();
                    if($pMethod == '__construct')
                    {
                        $res = $obj;
                    }
                    else
                    {
                        $res = \call_user_func_array(array($obj, $pMethod), $pArgs);
                    }
                    break;
            }
            return $res;
        }
        catch(Exception $e)
        {
            throw new EGenericCallInterface($e->getMessage());
        }
    }

    /**
     * return method call mode (static/object)
     * @param string $pClass class to call
     * @param string $pMethod method to call
     * @return string
     */
    public static function getCallMode($pClass, $pMethod)
    {
        $rf = new \ReflectionMethod($pClass, $pMethod);
        return ($rf->isStatic() ? self::MODE_STATIC : self::MODE_OBJECT);
    }
}