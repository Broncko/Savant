<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

namespace \Savant\Utils;

/**
 * @package    Savant
 * @subpackage Utils
 * Exception-handling for multilogging
 *
 */
class EMultiLogging extends \Savant\EException{}

/**
 * @package    Savant
 * @subpackage Utils
 * Administrates multiple loggers by using the composite pattern(extending SplObjectStorage).
 */
class CMultiLogging extends SplObjectStorage implements ILogging 
{	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * add logger
	 * @param ILogging $pLogger logger
	 */
	public function addLogger(ILogging $pLogger)
	{
		$this->attach($pLogger);
	}
	
	/**
	 * remove logger
	 * @param ILogging $pLogger logger
	 */
	public function removeLogger(ILogging $pLogger)
	{
		$this->detach($pLogger);
	}
	
	/**
	 * log each logger
	 * @param string $pText content
	 * @param string $pLevel loglevel
	 */
	public function log($pText = '', $pLevel = parent::LEVEL_DEBUG)
	{
		foreach($this as $logger)
		{
			$logger->log($pText, $pLevel);
		}
	}
}