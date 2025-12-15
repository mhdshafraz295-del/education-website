<?php
require_once __DIR__ . '/../app/controllers/RegisterController.php';

$controller = new RegisterController();

if (isset($_GET['page']) && $_GET['page'] === 'register') {

    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showRegisterForm();
    }

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->handleRegistration();
    }
}
    


?>