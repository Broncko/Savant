<?php
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\CConfigure;

class AConfigure extends AOP\AAspect implements AOP\IAspect
{
    public static function getJoinPointMask()
    {
        return array('CClassLoader');
    }

    public static function advice($pObj = null, AOP\AJoinPoint $pJoinPoint)
    {
        
    }
}