<?php
use \Savant\Controller\CFrontController as CFrontController;
use Savant\Template\CChunk as CChunk;
use Savant\Storage\DataSet\CDataSet as CDataSet;

require_once '../savant.php';

try 
{
    $engine = new CChunk();
    $fc = new CFrontController($engine);
    $testdata = new CDataSet();
    $testdata->addRow((object)array('testvar'=>'Welt'));
    $testdata->addRow((object)array('testvar2'=>'Hendrik'));
    $fc->merge($testdata);
    $fc->out();
}
catch(EException $e)
{
    echo $e;
}
?>
