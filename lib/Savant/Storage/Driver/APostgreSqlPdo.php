<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
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
 * postgresql pdo driver
 */
abstract class APostgreSqlPdo implements IDriver
{
    /**
     * connect database driver
     * @param \Savant\Storage\CDatabase $pDb
     * @return \PDO
     */
    public static function connect(\Savant\Storage\CDatabase $pDb)
    {
        $pDb->DSN = sprintf("pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s", $pDb->HOST, $pDb->PORT, $pDb->DATABASE, $pDb->USERNAME, $pDb->PASSWORD);
        try
        {
            return new \PDO($pDb->DSN);
        }
        catch(PDOException $e)
        {
            throw new \Savant\Storage\EDatabase($e->getMessage());
        }
    }

    /**
     * disconnnect database driver
     * @param \Savant\Storage\CDatabase $pDb
     */
    public static function disconnect(\Savant\Storage\CDatabase $pDb)
    {
        $pDb->con = null;
    }
}