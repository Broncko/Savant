<?php
namespace Savant\Storage;

class CNestedSet
{
    private $storage = null;

    public function __construct(IStorage $pStorage)
    {
        $this->storage = $pStorage;
    }
}