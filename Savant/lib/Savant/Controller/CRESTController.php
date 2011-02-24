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
 * exception handling of the REST Controller
 */
class ERESTController extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Controller
 * this controller provides the restful access to data
 */
class CRESTController extends CActionController
{
    public function resolveActionName()
    {
        if($this->request->getAction() === 'index')
        {
            switch($this->request->getMethod())
            {
                case 'GET':
                    $actionName = ($this->request->argumentExists('id') ? 'show' : 'list');
                    break;
                case 'PUT':
                    if(!$this->request->argumentExists('id'))
                    {
                        throw new ERESTController('missing argument id');
                    }
                    $actionName = 'update';
                    break;
                case 'POST':
                    $actionName = 'create';
                    break;
                case 'DELETE':
                    if(!$this->request->argumentExists('id'))
                    {
                        throw new ERESTController('missing argument id');
                    }
                    $actionName = 'delete';
                    break;
            }
        }
        parent::resolveActionName();
    }
}