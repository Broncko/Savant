<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Template
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Template;

/**
 * @package Savant
 * @subpackage Template
 * provides interface which has to be implement by template engines
 */
interface IEngine
{
    /**
     * render template
     */
    public function render($pDisplay = true);

    /**
     * assign data to template
     */
    public function assign($pData);
    /**
     * set template
     */
    public function setTemplate($pTemplate);
}