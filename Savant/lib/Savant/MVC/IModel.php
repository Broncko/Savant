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
namespace Savant\MVC;

/**
 * models have to implement this interface
 */
interface IModel
{
    /**
     * get query meta data
     */
    public function __metaDefaultQuery();

    /**
     * default query
     */
    public function defaultQuery();
}