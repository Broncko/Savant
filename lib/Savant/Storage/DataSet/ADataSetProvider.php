<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage DataSet
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Storage\DataSet;

/**
 * @package Storage
 * @subpackage DataSet
 * exception handling of CDataSetProvider
 */
class EDataSetProvider extends \Savant\EException {}

/**
 * @package Storage
 * @subpackage DataSet
 * this class provides datasets from several sources
 */
class ADataSetProvider extends \Savant\AStandardObject
{
    /**
     * table name
     * @var string
     */
    protected static $TABLE;

    /**
     * database object
     * @var \Savant\Storage\CDatabase
     */
    protected $db = null;

    /**
     * create datasetprovider instance
     * @param \Savant\Storage\CDatabase $db
     */
    public function __construct(\Savant\Storage\CDatabase $pDb)
    {
        parent::__construct();
        $this->db = $pDb;
        self::$TABLE = \array_pop(\explode('\\', \get_class($this)));
    }
    
    /**
     * query data set
     * @param string $pQuery
     * @param array $pParams
     * @param string $pConnection
     * @return \Savant\Storage\DataSet\CDataSet
     */
    public function _dsQuery($pQuery = 'Default', $pParams = array(), $pConnection = 'default')
    {
        $method = 'query'.$pQuery;
        if(!\method_exists($this, $method))
        {
            throw new EDataSetProvider("unknown query %s", $pQuery);
        }
        if($this->db == null || !$this->db->isConnected())
        {
            $this->db = new \Savant\Storage\CDatabase($pConnection);
        }
        $dataSet = new CDataSet($this->$method($pParams)->fetchAll());
        return $dataSet;
    }
}