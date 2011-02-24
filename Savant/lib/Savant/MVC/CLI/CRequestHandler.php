<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage MVC
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\MVC\CLI;

/**
 * exception handling of clirequesthandler
 * @package Savant
 * @subpackage MVC
 */
class ERequestHandler extends \Savant\EException {}

/**
 * provides a request handler for request over the command line interface
 * @package Savant
 * @subpackage MVC
 */
class CRequestHandler extends \Savant\AStandardObject implements IRequestHandler
{
    public function _handle(CRequest $pRequest)
    {

    }

    /**
     * check if request can be handled
     * @param CRequest $pRequest
     * @return bool
     */
    public function checkRequest(CRequest $pRequest)
    {
        return ($pRequest->method == 'cli');
    }

    /**
     * returns request handlers priority
     * @return integer
     */
    public function getPriority()
    {
        return 200;
    }
}