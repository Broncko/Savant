<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Aspects
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\AOP\Aspects;
use Savant\AOP;
use Savant\Utils\CFileLogging;

/**
 * @package AOP
 * @subpackage Aspects
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
