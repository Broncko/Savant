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
 * provides an mvc dispatcher. Dispatches requests to the controller
 * which was specified by the request and returns the response from the
 * controller
 * @package Savant
 * @subpackage MVC
 */
class CDispatcher extends \Savant\AStandardObject
{
    /**
     * application manager
     * @var \Savant\CApplication
     */
    public $appManager;

    /**
     * create mvc dispatcher instance
     * @param \Savant\CApplication $pAppManager
     */
    public function __construct(\Savant\CApplication $pAppManager)
    {
        $this->appManager = $pAppManager;
    }

    /**
     * dispatch request to controller and return response
     * @param IRequest $pRequest
     * @param IResponse $pResponse
     */
    public function dispatch(IRequest $pRequest, IResponse $pResponse)
    {
        
    }

    /**
     * resolve and instantiate controller which matches the given request
     * @param IRequest $pRequest
     */
    private function resolveController(IRequest $pRequest)
    {
        
    }
}