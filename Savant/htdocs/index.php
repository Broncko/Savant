<?php
print_r($_REQUEST);

echo "<pre>";
print_r($_SERVER);
echo "</pre>";

require_once 'savant.php';

Savant\Controller\CFrontController::handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>
