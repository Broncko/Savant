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
 * testcases have to implement this interface
 */
interface ITestCase
{
    /**
     * set up testcase properties and object etc.
     */
    public function setUp();

    /**
     * kill needed objects (connections, filehandles etc.)
     */
    public function tearDown();
}