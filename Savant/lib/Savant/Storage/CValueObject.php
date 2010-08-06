<?php
namespace Savant\Storage;

class CValueObject
{
    private $storage = array();

    public function __set($pKey, $pVal)
    {
        $this->storage[$pKey] = $pVal;
    }

    public function __get($pKey)
    {
        return $this->storage[$pKey];
    }

    public function getAll()
    {
        return $this->storage;
    }
}
