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
namespace Savant\Storage;

/**
 * @package Savant
 * @subpackage Storage
 * provides simple value object to store data more comfortably
 */
class CValueObject
{
    /**
     * storage
     * @var array
     */
    private $storage = array();

    /**
     * set data with key
     * @param string $pKey
     * @param mixed $pVal
     */
    public function __set($pKey, $pVal)
    {
        $this->storage[$pKey] = $pVal;
    }

    /**
     * get data with given key
     * @param string $pKey
     * @return mixed
     */
    public function __get($pKey)
    {
        return $this->storage[$pKey];
    }

    /**
     * return entire data storage
     * @return array
     */
    public function getAll()
    {
        return $this->storage;
    }
}
