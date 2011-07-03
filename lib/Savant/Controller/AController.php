<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Controller
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Controller;

/**
 * @package Savant
 * @subpackage Controller
 * exception handling of abstract controller
 */
class EController extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Controller
 * provides an abstract base class for controllers
 */
abstract class AController extends \Savant\AStandardObject
{
    /**
     * supported requests
     * @var array
     */
    protected $supportedRequests = array();

    /**
     * check if controller can handle the given type of request
     * @param \Savant\MVC\IRequest $pRequest
     * @return boolean
     */
    public function checkRequest(\Savant\MVC\IRequest $pRequest)
    {
        foreach($this->supportedRequests as $supportedRequest)
        {
            if($pRequest instanceof $supportedRequest)
            {
                return true;
            }
        }
        return false;
    }
}