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
 * mvc web response
 * @package Savant
 * @subpackage MVC
 */
class CResponse extends \Savant\AStandardObject
{
    /**
     * response content
     * @var string
     */
    public $content = null;

    /**
     * send response
     */
    public function send()
    {
        if($this->content !== null)
        {
            echo $this->content;
        }
    }
}