<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage AOP
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Database;

/**
 * @package    Savant
 * @subpackage Database
 * Exception-handling for DataSetQuery
 */
class EDataSetQuery extends Savant\EException {}

/**
 * @package Savant
 * @subpackage Database
 * Creates dataset from sql query
 */
class CDataSetQuery extends PDO 
{
	/**
	 * Constructor
	 * @param string $pQuery query
	 * @param array $pParams parameters
	 */
	public function __construct($pQuery = '', $pParams = array())
	{
		parent::__construct()
	}
	
	/**
	 * execute query
	 * @param string $pQuery query
	 * @param array $pParams parameters
	 */
	public function execute($pQuery = '', $pParams = array())
	{
		
	}
}