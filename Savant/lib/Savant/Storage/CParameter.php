<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage;

/**
 * @package Savant
 * provides a parameter value object
 */
class CParameter extends CValueObject
{
    /**
     * datatype string
     * @var string
     */
    const DT_STRING = 'string';

    /**
     * datatype integer
     * @var string
     */
    const DT_INTEGER = 'integer';

    /**
     * datatype boolean
     * @var string
     */
    const DT_BOOLEAN = 'boolean';

    /**
     * datatype float
     * @var string
     */
    const DT_FLOAT = 'float';

    /**
     * constraint nullable
     * @var string
     */
    const CS_NULLABLE = 'isNullable';

    /**
     * constraint mininum length
     * @var string
     */
    const CS_MINLENGTH = 'minlength';

    /**
     * constraint maximum length
     * @var string
     */
    const CS_MAXLENGTH = 'maxlenght';

    /**
     * constraint minimum value
     * @var string
     */
    const CS_MINVAL = 'minval';

    /**
     * constraint maximum value
     * @var string
     */
    const CS_MAXVAL = 'maxval';

    /**
     * constraint regex
     * @var string
     */
    const CS_REGEX = 'regEx';

    /**
     * parameter name
     * @var string
     */
    public $name = '';

    /**
     * parameter type, types are defined in this class DT_*, default is DT_STRING
     * @var string
     */
    public $type = self::DT_STRING;

    /**
     * parameter description
     * @var string
     */
    public $description = '';

    /**
     * parameter constraints
     * @var array
     */
    public $constraints = array();

    /**
     * parameter value
     * @var mixed
     */
    public $value = null;

    /**
     * parameter default value
     * @var mixed
     */
    public $default = null;

    /**
     * create parameter instance
     * @param string $pName
     * @param string $pType
     * @param string $pDescription
     * @param array $pConstraints
     * @param mixed $pDefault
     */
    public function __construct($pName, $pValue, $pType = self::DT_STRING, $pDescription = '', $pConstraints = array(), $pDefault = null)
    {
        parent::__construct();
        $this->name = $pName;
        $this->value = $pValue;
        $this->type = $pType;
        $this->description = $pDescription;
        $this->constraints = $pConstraints;
        $this->default = $pDefault;
    }
}