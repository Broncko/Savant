<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage AOP
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;

class EGenericCallInterface extends EException {}

/**
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
     * @param string $pClass
     * @param string $pMethod
     * @param array $pArgs
     * @param array $pOpts
     */
    public function call($pClass, $pMethod = 'main', $pArgs = array(), $pOpts = array())
    {
        if(!\class_exists($pClass))
        {
            throw new EGenericCallInterface('class does not exist');
        }
        if(!\method_exists($pClass, $pMethod))
        {
            throw new EGenericCallInterface('method does not exist');
        }
        switch($pOpts['mode'])
        {
            case self::MODE_STATIC:
                $res = \call_user_func_array(array($pClass, $pMethod), $pArgs);
                break;
            case self::MODE_OBJECT:
                $instance = new $pClass;
                $res = \call_user_func_array(array($instance, $pMethod), $pArgs);
        }
        return $res;
    }
}