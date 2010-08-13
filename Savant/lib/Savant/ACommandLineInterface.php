<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;

/**
 * @package Savant
 * exception handling of commandline interface
 */
class ECommandLineInterface extends EException {}

/**
 * @package Savant
 * @abstract ACommandLineInterface
 * provides a Command Line Interface (CLI)
 */
abstract class ACommandLineInterface
{
    /**
     * process command line arguments and execute the specified routine
     * @param array $args command line argument
     * @return mixed result of the executed routine
     */
    public static function main($pArgs = array())
    {
        if(!\is_array($pArgs))
        {
            throw new ECommandLineInterface("invalid argruments");
        }
        $parsedArgs = self::parseArgs($pArgs);
        $res = AGenericCallInterface::call($parsedArgs->class, $parsedArgs->method, $parsedArgs->args);
        print_r($res);
        return true;
    }

    /**
     * parse given parameters
     * @static parseArgs
     * @param string $pArgs
     * @return object
     */
    public static function parseArgs($pArgs)
    {
        $argArr['self'] = \array_shift($pArgs);
        $argArr['class'] = \array_shift($pArgs);
        $argArr['method'] = \array_shift($pArgs);
        $argArr['args'] = $pArgs;

        return (object)$argArr;
    }

    private static function getHelp()
    {

    }
}