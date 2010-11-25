<?php
namespace testApp\models;

class testData extends \Savant\Storage\DataSet\ADataSetProvider
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
}