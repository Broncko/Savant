<?php
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\Utils\CFileLogging;

abstract class ALogging extends AOP\AAspect implements AOP\IAspect
{
    public static $BASE_CLASS = 'Savant\Utils\CFileLogging';

    /*public static function getJoinPointMask()
    {
        return array(
            'Savant\AOP\JoinPoints\CMethodCall',
            'Savant\AOP\JoinPoints\CConstructor',
            'Savant\AOP\JoinPoints\CDestructor'
        );
    }*/

    public static function advice($pObj, AOP\AJoinPoint $pJoinPoint)
    {   
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

        $method = (\property_exists($pJoinPoint, 'METHOD') ? $pJoinPoint->METHOD : '');
        $args = (\property_exists($pJoinPoint, 'ARGS') ? $pJoinPoint->ARGS : array());

        $content = sprintf('%s%s %s %s->%s(%s)',$indent,$action,$pJoinPoint->LABEL,$pJoinPoint->CLASS,$method,implode(',',$args));
        \Savant\CBootstrap::log($content);
    }
}
