<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/logincontroller.php';

$loginController = new LoginController();
$loginController->showLoginForm();

  
?>