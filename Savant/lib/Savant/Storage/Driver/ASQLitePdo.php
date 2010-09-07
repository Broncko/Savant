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
 * sqlite pdo driver
 */
abstract class ASQLitePdo implements IDriver
{
    /**
     * connect database driver
     * @param \Savant\Storage\CDatabase $pDb
     */
    public function connect(\Savant\Storage\CDatabase $pDb)
    {
        $pDb->DSN = sprintf("sqlite:%s", $pDb->DATABASE);
        $pDb->dbh = new \PDO($pDb->DSN, $pDb->USERNAME, $pDb->PASSWORD);
    }

    /**
     * disconnnect database driver
     * @param \Savant\Storage\CDatabase $pDb
     */
    public function disconnect(\Savant\Storage\CDatabase $pDb)
    {
        $pDb->DSN = null;
    }
}