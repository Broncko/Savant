<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility collection of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils;

/**
 * @package Savant
 * @subpackage Utils
 * exception handling of CDbLoggin
 */
class EDbLogging extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Utils
 * writes logdata to a database
 */
class CDbLogging extends \Savant\AStandardObject implements ILogging, \Savant\IConfigure
{
    /**
     * database connection
     * @var string
     */
    public $CON;

    /**
     * database table
     * @var string
     */
    public $TABLE;

    /**
     * database table field
     * @var string
     */
    public $FIELD;

    /**
     * create db logger instance
     * @param string $pSection
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    /**
     * log
     * @param string $pText
     */
    public function log($pText, $pLevel = \Savant\CBootstrap::LEVEL_DEBUG)
    {
        $db = new \Savant\Storage\CDatabase($this->CON);
        $db->exec(sprintf("INSERT INTO %s VALUES(%s)",$this->TABLE,$pText));
    }
}