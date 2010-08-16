<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
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
 * exception handling of AAutoTestCase
 */
class EAutoTestCase extends EException {}

/**
 * @package Savant
 * just an empty class frame to provide an interface to extend testcases.
 * if a testcase extends this class it will automatically be tested by the
 * test suite.
 */
abstract class AAutoTestCase extends ATestCase {} 