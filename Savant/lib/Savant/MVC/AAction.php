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
 * exception handling of AAction
 */
class EAction extends \Savant\EException {}

/**
 * provides abstract action controller that can be used to derive action
 * controller classes from
 */
abstract class AAction
{
    /**
     * get meta info of given method
     * @param string $pMethod
     */
    public function getMetaInfo($pMethod)
    {
        
    }
}