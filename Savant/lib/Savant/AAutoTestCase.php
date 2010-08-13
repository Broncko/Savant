<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
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
 * @abstract AAutoTestCase
 * @package Savant
 * just an empty class frame to provide an interface to extend to testcases
 */
abstract class AAutoTestCase extends ATestCase {} 