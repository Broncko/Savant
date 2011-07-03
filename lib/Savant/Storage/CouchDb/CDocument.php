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
namespace Savant\Storage\CouchDb;

/**
 * @package Savant
 * @subpackage CouchDb
 * exception handling of CDocument
 */
class EDocument extends \Savant\Protocol\ERest {}

/**
 * @package Savant
 * @subpackage CouchDb
 * provides a couchdb document wrapper
 */
class CDocument extends \Savant\Storage\CValueObject
{
    /**
     * create a document wrapper instance
     * @param array $pData
     */
    public function __construct($pData = array())
    {
        parent::__construct($pData);
    }

    /**
     * encode in json format when object is serialized
     * @return string
     */
    public function __sleep()
    {
        return \Savant\Protocol\CJson::encode($this->storage);
    }

    /**
     * decode json and return native php when object is unserialized
     * @return string
     */
    public function __wakeup()
    {
        return \Savant\Protocol\CJson::decode($this->storage);
    }
}