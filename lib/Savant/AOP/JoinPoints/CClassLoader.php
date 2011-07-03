<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage JoinPoints
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\AOP\JoinPoints;
use Savant\AOP\AJoinPoint;

/**
 * @package AOP
 * @subpackage JoinPoints
 * joinpoint classloader
 */
class CClassLoader extends AJoinPoint
{
    /**
     * label
     * @var string
     */
    public $LABEL = 'load class';

    /**
     * name
     * @var string
     */
    public $NAME = 'Classloader';

    /**
     * class loader
     * @var object
     */
    public $loader = null;

    /**
     * class file
     * @var string
     */
    public $file = null;

    /**
     * create joinpoint instance
     * @param string $pClass
     * @param object $pLoader
     * @param string $pFile
     */
    public function __construct($pClass, $pLoader = null, $pFile = null)
    {
        parent::__construct($pClass);
        $this->loader = $pLoader;
        $this->file = $pFile;
    }
}