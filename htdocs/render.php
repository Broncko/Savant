<?php
use \Savant\Controller\CFrontController as CFrontController;
use Savant\Storage\DataSet\CDataSet as CDataSet;

require_once '../savant.php';

try 
{
    $engine = new \Savant\Template\CTwig();
    $tplFile = 'test' . $engine::SUFFIX;
    $engine->setTemplate($tplFile);
    $fc = new CFrontController($engine);
    
    $testdata = new Savant\Storage\CValueObject();
    $testdata->testvar = "World";
    $testdata->hendrik = (object)array("name" => "Broncko");
    $fc->merge($testdata);
    $fc->out();
}
catch(EException $e)
{
    echo $e;
}
?>
