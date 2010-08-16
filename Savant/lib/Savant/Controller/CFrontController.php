<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the controller package Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Controller
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

namespace Savant\Controller;

/**
 * @package    Savant
 * @subpackage Controller
 * Exception-handling for front controller
 *
 */
class EFrontController extends \Savant\EException {}


/**
 * @package    Savant
 * @subpackage Controller
 * provides front controller functionality
 * handles request from client and transforms it to needed data to proceed with the framework
 * 
 */
class CFrontController
{
    public $engine = null;

    public function __construct(\Savant\Template\IEngine $pEngine)
    {
        $this->engine = $pEngine;
    }

    public function parseRequest()
    {
        print_r($_REQUEST);
    }
}