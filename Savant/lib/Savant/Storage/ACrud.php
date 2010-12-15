<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Storage
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage;

/**
 * @package Savant
 * @subpackage Storage
 * exception handling of ACrud
 */
class ECrud extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Storage
 * provides basic CRUD operations as a dataset provider
 */
abstract class ACrud extends DataSet\ADataSetProvider implements \Savant\Webservice\IRestful
{
    /**
     * create crud instance
     */
    public function __construct(CDatabase $pDb)
    {
        parent::__construct($pDb);
    }

    /**
     * post operation
     * @param array $pData
     * @return array
     */
    public function create($pData)
    {
        $sql = "insert into %s (%s) values ('%s')";

        $filled = sprintf($sql,
                          self::$TABLE,
                          \implode(",", \array_keys((array)$pData['fields'])),
                          \implode("','", \array_values((array)$pData['fields'])));

        return $this->db->exec($filled);
    }

    /**
     * get operation
     * @param array $pData
     * @return array
     */
    public function read($pData = null)
    {
        $sql = "select * from %s";
        if(!\is_null($pData) && \key_exists(':id', $pData))
        {
            $sql .= " where testcol = %s";

            $filled = sprintf($sql, self::$TABLE, $pData[':id']);

            foreach($this->db->exec($filled) as $row)
            {
                $res[] = $row;
            }
            return $res;
        }

        $filled = sprintf($sql, self::$TABLE);
        
        foreach($this->db->exec($filled) as $row)
        {
            $res[] = $row;
        }
        return $res;
    }

    /**
     * put operation
     * @param array $pData
     * @return array
     */
    public function update($pData)
    {
        $sql = "update %s set %s where testcol=:id";
        foreach($pData['fields'] as $field => $value)
        {
            $fields[] = $field . '=\'' . $value . '\'';
        }
        $filled = sprintf($sql,
                          self::$TABLE,
                          \implode(",", $fields));

        unset($pData['fields']);
        return array("success" => $this->db->query($filled, $pData));
    }

    /**
     * delete operation
     * @param array $pData
     * @return array
     */
    public function delete($pData)
    {
        $sql = "delete from %s where testcol=:id";

        $filled = sprintf($sql, self::$TABLE);

        return array("success" => $this->db->query($filled, $pData));
    }
}
