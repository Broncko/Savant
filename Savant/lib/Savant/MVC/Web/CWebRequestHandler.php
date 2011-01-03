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
namespace Savant\MVC\Web;

/**
 * exception handling of CWebRequestHandler
 * @package Savant
 * @subpackage MVC
 */
class ERequestHandler extends \Savant\EException {}

/**
 * provides a request handler for web-requests
 * @package Savant
 * @subpackage MVC
 */
class CRequestHandler extends \Savant\AStandardObject implements IRequestHandler
{
    public function _handle(CRequest $pRequest)
    {
        $this->resolveController($pRequest);
    }

    public function _resolveController(CRequest $pRequest)
    {
        print_r($pRequest->uri);
    }

    /**
     * check if request can be handled
     * @param CRequest $pRequest
     * @return bool
     */
    public function checkRequest(CRequest $pRequest)
    {
        return (\in_array($pRequest->method, array('GET', 'POST', 'PUT', 'DELETE')));
    }

    /**
     * returns request handlers priority
     * @return integer
     */
    public function getPriority()
    {
        return 100;
    }
}