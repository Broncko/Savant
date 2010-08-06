<?php
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\Utils\CFileLogging;

abstract class ALogging extends AOP\AAspect implements AOP\IAspect
{
    public static function getJoinPointMask()
    {
        return '*';
    }

    public static function advice($pObj = null, AOP\CJoinPoint $pJoinPoint)
    {
        $instance = new CFileLogging();

        switch($pJoinPoint->DIRECTION)
        {
                case AOP\CJoinPoint::DIRECTION_IN:
                        $content = sprintf('%senter %s %s->%s(%s)',$indent,$pJoinPoint->NAME,$pJoinPoint->CLASS,$pJoinPoint->METHOD,implode(',',$pJoinPoint->ARGS));
                        $instance->log($content);
                        self::$INDENT_COUNT += 1;
                        break;
                case AOP\CJoinPoint::DIRECTION_OUT:
                        $content = sprintf('%sleave %s %s->%s',$indent,$pJoinPoint->NAME,$pJoinPoint->CLASS,$pJoinPoint->METHOD);
                        self::$INDENT_COUNT -= 1;
                        $instance->log($content);
                        break;
                default:
                        break;
        }
    }
}
