<?php
require_once '../savant.php';

$server = \Savant\CRemoteXMLRPCServer::create();
$server->handle($HTTP_RAW_POST_DATA);