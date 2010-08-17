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
 * database driver interface. Each database driver class has to implement this
 * interface to provide global db functionality
 */
interface IDriver
{
    /**
     * establish db connection
     */
    public function connect(Savant\Storage\CDatabase $pDb);

    /**
     * kill db connection
     */
    public function disconnect();
}