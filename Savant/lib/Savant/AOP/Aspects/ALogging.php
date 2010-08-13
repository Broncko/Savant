<?php
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\Utils\CFileLogging;

abstract class ALogging extends AOP\AAspect implements AOP\IAspect
{
    public static function getJoinPointMask()
    {
        return array('Savant\AOP\JoinPoints\CMethodCall');
    }

    public static function advice($pObj = null, AOP\AJoinPoint $pJoinPoint)
    {
        $instance = new CFileLogging();
        
        switch($pJoinPoint->DIRECTION)
        {
                case AOP\AJoinPoint::DIRECTION_IN:
                        $indent = \str_repeat(CFileLogging::LOG_INDENT, CFileLogging::$INDENT_COUNT);
                        $action = 'enter';
                        CFileLogging::$INDENT_COUNT += 1;
                        break;
                case AOP\AJoinPoint::DIRECTION_OUT:
                        CFileLogging::$INDENT_COUNT -= 1;
                        $indent = \str_repeat(CFileLogging::LOG_INDENT, CFileLogging::$INDENT_COUNT);
                        $action = 'leave';
                        break;
        }
        $content = sprintf('%s%s %s %s->%s(%s)',$indent,$action,$pJoinPoint->NAME,$pJoinPoint->CLASS,$pJoinPoint->METHOD,implode(',',$pJoinPoint->ARGS));
        $instance->log($content);
    }
}
