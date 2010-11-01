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
 * exception handling of CCouchDb
 */
class ECouchDb extends \Savant\Protocol\ERest {}

/**
 * @packgage Savant
 * @subpackage Storage
 * provides couchdb as rest based storage service
 */
class CCouchDb extends \Savant\Protocol\ARest implements \Savant\IConfigure
{
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    public function createDb($pDbName)
    {
        self::$HOST = 'localhost';
        self::$PORT = '5984';
        $this->put('/albums');
    }
}