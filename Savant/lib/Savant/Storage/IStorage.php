<?php
namespace Savant\Storage;

interface IStorage
{
    public function store();

    public function delete();

    public function configure();
}
