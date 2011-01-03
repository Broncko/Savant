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
namespace Savant\MVC;

/**
 *  provides interface for mvc request handlers
 *  @package Savant
 *  @subpackage MVC
 */
interface IRequestHandler
{
    /**
     * handle requests
     */
    public function _handle(CRequest $pRequest);

    /**
     * check if request can be handled
     */
    public function checkRequest(CRequest $pRequest);

    /**
     * get request handler priority
     */
    public function getPriority();
}