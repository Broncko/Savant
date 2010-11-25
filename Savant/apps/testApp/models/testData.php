<?php
namespace testApp\models;

class testData extends \Savant\Storage\DataSet\ADataSetProvider implements \Savant\MVC\IModel
{
    const DEFAULT_DB = 'savant_mysql';

    public function queryName()
    {
        $sql = "select
                *
                from
                test";

        return $this->db->query($sql);
    }

    public function meta__queryIndex()
    {
        return true;
    }

    public function queryIndex()
    {
        return true;
    }
}