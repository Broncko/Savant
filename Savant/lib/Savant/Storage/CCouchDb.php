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
    /**
     * current database
     * @var string
     */
    private $curDb;

    /**
     * database configurable member
     * @var string
     */
    public static $DATABASE;

    /**
     * create couchdb instance
     * @param string $pSection
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
        self::$HOST = 'http://localhost';
        self::$PORT = '5984';
        $this->actDb = self::$DATABASE = 'testdb';
    }

    /**
     * create new database
     * @param string $pDbName
     */
    public function createDb($pDbName)
    {
        $res = $this->put("/".$pDbName);
        if(\property_exists($res, 'error'))
        {
            throw new ECouchDb($res->error.': '.$res->reason);
        }
        $this->actDb = $pDbName;
    }

    /**
     * create new couchdb document
     * @param string $pName
     * @param array $pData
     */
    public function createDocument($pName, $pData = array())
    {
        $data = array("identifier" => "Broncko", "coolness" => "huge", "attribute" => "awesome");
        $url = "testdb/awesomeness";
        $this->delete($url);
    }

    /**
     * return a unique id
     * @param integer $pCount
     */
    public function getUuid($pCount = 1)
    {
        $data = array();
        if($pCount != 1)
        {
            $data = array("count" => $pCount);
        }
        $url = "_uuids";
        print_r($this->send($url, self::RM_GET, $data));
    }
}