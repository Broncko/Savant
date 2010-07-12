<?php
use \Savant\Controller\CFrontController as CFrontController;

require_once 'bootstrapper.php';

try 
{
	echo "<pre>";
	$webservice = CFrontController::main();
	$webservice->querySomething('test', array('test1','test2'));
	echo "</pre>";
}
catch(Exception $e)
{
	print_r($e->getTrace());
}
?>