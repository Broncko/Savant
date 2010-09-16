<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
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
class ECommandLineInterface extends EException
{
    public function __toString()
    {
        return $this->getMessage()."\n";
    }
}

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
        if(count($pArgs) < 2)
        {
            print("Usage: savant [OPTIONS] CLASS[::METHOD] [ARGUMENTS]\nTry savant --help for more information\n");
        }
        else
        {
            $parsedArgs = self::parseArgs($pArgs);
            if(isset($parsedArgs->options) == '--help')
            {
                print(self::getHelp());
                return true;
            }
            $res = AGenericCallInterface::call($parsedArgs->class, $parsedArgs->method, $parsedArgs->args);
            print_r($res);
            return true;
        }
    }

    /**
     * parse given parameters
     * @static parseArgs
     * @param string $pArgs
     * @return object
     */
    public static function parseArgs($pArgs)
    {
        print_r($pArgs);
        $argArr['self'] = \array_shift($pArgs);
        if($pArgs[0][0] == '-')
        {
            $argArr['options'] = \array_shift($pArgs);
        }
        $classmethod = \array_shift($pArgs);
        if(\strpos($classmethod, "::") === true)
        {
            list($argArr['class'],$argArr['method']) = \explode('::', $classmethod);
        }
        else
        {
            $argArr['class'] = $classmethod;
            $argArr['method'] = 'main';
        }
        $argArr['args'] = $pArgs;

        return (object)$argArr;
    }

    private static function getHelp()
    {
        return "Please hold the line";
    }
}