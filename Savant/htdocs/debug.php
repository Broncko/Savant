<?php
echo "before savant";
require_once '../savant.php';
echo "after savant";
$fc = new \Savant\Controller\CFrontController(new \Savant\Template\CTwig());
$fc->parseRequest();
?>