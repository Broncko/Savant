<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage DataSet
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage\DataSet;

/**
 * @package Storage
 * @subpackage DataSet
 * exception handling of CDataSetProvider
 */
class EDataSetProvider extends \Savant\EException {}

/**
 * @package Storage
 * @subpackage DataSet
 * this class provides datasets from several sources
 */
class CDataSetProvider
{
    /**
     * database object
     * @var \Savant\Storage\CDatabase
     */
    private $db = null;
    
    public function __construct($pSection = 'default')
    {
        
    }

    public function query($pSql, $pParams = array())
    {

    }
}