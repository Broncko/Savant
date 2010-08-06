<?php
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\CConfigure;

class AConfigure extends AOP\AAspect implements AOP\IAspect
{
    public static function getJoinPointMask()
    {
        return array('CClassLoader', 'CConstructor');
    }

    public static function advice(&$pObj = null, AOP\AJoinPoint $pJoinPoint)
    {
        switch($pJoinPoint)
        {
            case $pJoinPoint instanceof AOP\JoinPoints\CConstructor:
                if($pJoinPoint->DIRECTION == AOP\AJoinPoint::DIRECTION_IN)
                {
                    self::onBeforeConstructor($pObj, $pJoinPoint);
                }
                break;
            case $pJoinPoint instanceof AOP\JoinPoints\CClassLoader:
                if($pJoinPoint->DIRECTION == AOP\AJoinPoint::DIRECTION_OUT)
                {
                    self::onAfterLoadClass($pObj, $pJoinPoint);
                }
                break;
        }
    }

    public static function onBeforeConstructor(&$pObj, AOP\AJoinPoint $pJoinPoint)
    {
        if(!($pObj instanceof \Savant\IConfigure))
        {
            return;
        }

        $class = \get_class($pObj);
        $config = CConfigure::getClassConfig($class);
        foreach($config->children() as $confProp => $confVal)
        {
            try
            {
                $propObj = new ReflectionProperty($class, $confProp);
                $propObj->setValue($pObj, $confVal);
            }
            catch(ReflectionException $e)
            {

            }
        }
    }

    public static function onAfterLoadClass(&$pObj, AOP\AJoinPoint $pJoinPoint)
    {

    }
}