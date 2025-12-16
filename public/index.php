<?php
session_start();


$controller = $_GET['controller'] ?? 'login';
$action = $_GET['action'] ?? 'index';


switch ($controller) {
    case 'register':
        require_once __DIR__ . '/../app/controllers/registercontroller.php';
        break;
        
    case 'login':
        require_once __DIR__ . '/../app/controllers/logincontroller.php';
        break;
        
    case 'book':
        require_once __DIR__ . '/../app/controllers/BookController.php';
        break;
        
    case 'exam':
        require_once __DIR__ . '/../app/controllers/ExamController.php';
        break;
        
    default:
        require_once __DIR__ . '/../app/controllers/logincontroller.php';
        break;
}
?>