<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils;

/**
 * @package Savant
 * @subpackage Utils
 * exception handling of CCompiler
 */
class ECompiler extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Utils
 * provides a php class compiler, writes the defined class as bytecode
 */
class CCompiler
{
    /**
     * file handler
     * @var resource
     */
    private $fileHandler;

    /**
     * compile
     * @param string $pClass
     */
    public function compile($pClass)
    {
        $this->fileHandler = \fopen(\Savant\CBootstrap::$DATA_DIR. \DIRECTORY_SEPARATOR. \str_replace('\\', '_', $pClass), 'w');
        \bcompiler_write_header($this->fileHandler);
        $this->compileClass($pClass);
        \bcompiler_write_footer($this->fileHandler);
        \fclose($this->fileHandler);
    }

    /**
     * compile class recursively
     * @param string $pClass
     */
    private function compileClass($pClass)
    {
        $rf = new \ReflectionClass($pClass);
        if(!$rf->getParentClass())
        {
            $intArr = $rf->getInterfaceNames();
            if(count($intArr) > 0)
            {
                foreach($intArr as $interface)
                {
                    \bcompiler_write_class($this->fileHandle, $interface);
                }
            }
        }
        else
        {
            $this->compileClass($rf->getParentClass());
        }
    }

    /**
     * create instance
     * @return \Savant\Utils\CCompiler
     */
    public static function create()
    {
        return new self();
    }
}