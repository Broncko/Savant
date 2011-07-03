<?php
require_once 'savant.php';
use Savant\MVC;

/*Savant\CBootstrap::invoke(  'Savant\Controller\CFrontController',
                            'handle',
                            array($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']));*/

$resolver = new MVC\CRequestResolver();
$request = $resolver->build();

$resolver->registerRequestHandler(new MVC\CWebRequestHandler());
$resolver->registerRequestHandler(new MVC\CCLIRequestHandler());

$requestHandler = $resolver->resolveHandler($request);
print_r($requestHandler);
$requestHandler->handle($request);
?>
