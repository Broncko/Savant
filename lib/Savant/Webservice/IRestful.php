<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Webservice
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Webservice;

/**
 * provides an interface which covers the basic CRUD operations to support rest
 * functionality
 */
interface IRestful
{
    /**
     * create model
     * represents post request
     */
    public function create($pData);

    /**
     * read model
     * represents get request
     */
    public function read($pData);

    /**
     * update model
     * represents put request
     */
    public function update($pData);

    /**
     * delete model
     * represents delete request
     */
    public function delete($pData);
}