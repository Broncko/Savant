<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Storage
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage;

/**
 * @package    Savant
 * @subpackage Storage
 * handles error management of DatabaseMapper
 */
class EDbMapper extends \Savant\EException {}

/**
 * @package    Savant
 * @subpackage Storage
 * provides mapping functionality from objects to databases
 */
class CDbMapper
{
    /**
     * value object to map to db
     * @var object $valObj
     */
    private $valObj = null;

    /**
     * database columns
     * @var array $dbFields
     */
    private $dbFields = array();

    /**
     * Constructor
     * @param CValueObject $pObj
     */
    public function __construct(CValueObject $pObj)
    {
        $this->valObj = $pObj;
    }

    /**
     * map public properties of value object to db columns
     * @return array dbFields
     */
    public function map()
    {
        $rf = new \ReflectionObject($this->valObj);
        foreach($rf->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop)
        {
            $this->dbFields[$prop->name] = $this->valObj->{$prop->name};
        }
        return $this->dbFields;
    }

    /**
     * save object to database table
     * @param string $pTable database tablename to save object to
     * @return string
     */
    public function save($pTable = '')
    {
        $sqlFields = \implode(',', $this->dbFields);
        return $sqlFields;
    }
}
