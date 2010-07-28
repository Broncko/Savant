<?php
namespace Savant\Storage;

class EParameter extends \Savant\EException {}

class CParameter extends CValueObject
{
    const DT_STRING = 'string';

    const DT_INTEGER = 'integer';

    const DT_BOOLEAN = 'boolean';

    const DT_FLOAT = 'float';

    const CS_NULLABLE = 'isNullable';

    const CS_MINLENGTH = 'minlength';

    const CS_MAXLENGTH = 'maxlenght';

    const CS_MINVAL = 'minval';

    const CS_MAXVAL = 'maxval';

    const CS_REGEX = 'regEx';

    public $name = '';

    public $type = self::DT_STRING;

    public $description = '';

    public $constraints = array();

    public $value = null;

    public $default = null;

    public function __construct($pName, $pType = self::DT_STRING, $pDescription = '', $pConstraints = array(), $pDefault = null)
    {
        parent::__construct();
        $this->name = $pName;
        $this->type = $pType;
        $this->description = $pDescription;
        $this->constraints = $pConstraints;
        $this->default = $pDefault;
    }
}