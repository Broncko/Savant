<?php
require_once 'savant.php';

Savant\CBootstrap::invoke(  'Savant\Controller\CFrontController',
                            'handle',
                            array($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']));
?>
