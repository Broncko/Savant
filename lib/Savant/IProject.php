<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant;

/**
 * @package Savant
 * defines how an application looks like
 */
interface IProject
{
    /**
     * set application folder structure
     */
    public static function setFolderStructure($pBaseDir);

    /**
     * class loader
     */
    public static function loadClass($pClass);
}