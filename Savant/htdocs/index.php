<?php
print_r($_REQUEST);

require_once 'savant.php';

print_r($_REQUEST);

Savant\Controller\CFrontController::handle($_SERVER['REQUEST_URI']);
?>
