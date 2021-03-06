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

/**
 * @namespace Savant\AOP\Aspects
 */
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\Utils\CFileLogging;

/**
 * provides aspect decorator of logging
 */
abstract class ALogging extends AOP\AAspect implements AOP\IAspect
{
    /**
     * define base class of this aspect
     * @var string
     */
    public static $BASE_CLASS = 'Savant\Utils\CFileLogging';

    /**
     * provides aspect functionality
     * @param object $pObj object to configure
     * @param AOP\AJoinPoint $pJoinPoint joinpoint
     */
    public static function advice($pObj, AOP\AJoinPoint $pJoinPoint)
    {
        $method = (\property_exists($pJoinPoint, 'METHOD') ? $pJoinPoint->METHOD : '');
        $args = (\property_exists($pJoinPoint, 'ARGS') ? $pJoinPoint->ARGS : array());

        switch($pJoinPoint->DIRECTION)
        {
            case AOP\AJoinPoint::DIRECTION_IN:
                $indent = \str_repeat(CFileLogging::LOG_INDENT, CFileLogging::$INDENT_COUNT);
                CFileLogging::$INDENT_COUNT += 1;
                switch(true)
                {
                    case $pJoinPoint instanceof AOP\JoinPoints\CConstructor:
                    case $pJoinPoint instanceof AOP\JoinPoints\CDestructor:
                        $content = sprintf('%s%s %s', $indent, $pJoinPoint->LABEL, $pJoinPoint->CLASS);
                        break;
                    case $pJoinPoint instanceof AOP\JoinPoints\CException:
                        $content = sprintf('%s%s %s %s', $indent, $pJoinPoint->LABEL, $pJoinPoint->CLASS, $pJoinPoint->MESSAGE);
                        break;
                    case $pJoinPoint instanceof AOP\JoinPoints\CClassLoader:
                        $content = sprintf('%s%s %s from frile %s', $indent, $pJoinPoint->LABEL, $pJoinPoint->CLASS, $pJoinPoint->file);
                        break;
                    case $pJoinPoint instanceof AOP\JoinPoints\CMethodCall:
                        $strArgs = array();
                        foreach($args as $argument)
                        {
                            if(\is_object($argument))
                            {
                                $strArgs[] = \get_class($argument);
                            }
                            else
                            {
                                $strArgs[] = (string)$argument;
                            }
                        }
                        $content = sprintf('%senter %s %s->%s(%s)',$indent, $pJoinPoint->LABEL, $pJoinPoint->CLASS, $method, \implode(',', $strArgs));
                        break;
                    default:
                        $content = sprintf('%senter %s->%s(%s)',$indent, $pJoinPoint->CLASS, $method, \implode(',', $args));
                }
                break;
            case AOP\AJoinPoint::DIRECTION_OUT:
                CFileLogging::$INDENT_COUNT -= 1;
                $indent = \str_repeat(CFileLogging::LOG_INDENT, CFileLogging::$INDENT_COUNT);
                switch(true)
                {
                    case $pJoinPoint instanceof AOP\JoinPoints\CMethodCall:
                        $content = sprintf('%sleave %s %s->%s',$indent, $pJoinPoint->LABEL, $pJoinPoint->CLASS, $method);
                        break;
                    case $pJoinPoint instanceof AOP\JoinPoints\CConstructor:
                    case $pJoinPoint instanceof AOP\JoinPoints\CDestructor:
                    case $pJoinPoint instanceof AOP\JoinPoints\CClassLoader:
                    case $pJoinPoint instanceof AOP\JoinPoints\CException:
                    default:
                        break;
                }
                break;
        }
        if(isset($content) && $content != '')
        {
            \Savant\CBootstrap::log($content);
        }
    }
}
