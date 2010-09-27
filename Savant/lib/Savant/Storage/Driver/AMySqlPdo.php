<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Driver
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage\Driver;

/**
 * @package Storage
 * @subpackage Driver
 * exception handling of AMySqlPdo
 */
class EMySqlPdo extends \Savant\EException {}

/**
 * @package Storage
 * @subpackage Driver
 * provides abstract database driver for mysql databases based on php data
 * objects (PDO)
 */
abstract class AMySqlPdo implements IDriver
{
    /**
     * connect database driver
     * @param \Savant\Storage\CDatabase $pDb
     * @return \PDO
     */
    public static function connect(\Savant\Storage\CDatabase $pDb)
    {
        $dsn = \sprintf("mysql:host=%s;dbname=%s", (string)$pDb->HOST, (string)$pDb->DATABASE);
        try
        {
            return new \PDO($dsn, (string)$pDb->USERNAME, (string)$pDb->PASSWORD);
        }
        catch(PDOException $e)
        {
            throw new \Savant\Storage\EDatabase($e->getMessage());
        }
    }

    /**
     * disconnect from database
     * @param \Savant\Storage\CDatabase $pDb
     */
    public static function disconnect(\Savant\Storage\CDatabase $pDb)
    {
        $pDb->con = null;
    }
}