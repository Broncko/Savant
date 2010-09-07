<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;
//require_once 'extNamespaceWrapper.php';

/**
 * @package Savant
 * exception handling of CExtension
 */
class EExtension extends EException {}

/**
 * @package Savant
 * 
 */
abstract class AExtension extends AStandardObject implements IConfigure
{
    public $DIR = '';

    public $NAME = '';

    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function load()
    {

    }

}