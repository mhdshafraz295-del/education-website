<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$page = $_GET['page'] ?? 'login';

switch ($page) {

    case 'register':
        require_once __DIR__ . '/../app/controllers/RegisterController.php';
        $controller = new RegisterController();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->handleRegistration();
        } else {
            $controller->showRegisterForm();
        }
        break;

    case 'login':
        require_once __DIR__ . '/../app/controllers/LoginController.php';
        $controller = new LoginController();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->handleLogin();
        } else {
            $controller->showLoginForm();
        }
        break;

    case 'student-dashboard':
        require_once __DIR__ . '/../app/views/student_dashboard.php';
        break;

    

    case 'examination-officer':
        require_once __DIR__ . '/../app/controllers/ExamController.php';
        $controller = new ExamController();
        $exams = $controller->index();
        require_once __DIR__ . '/../app/views/examination_officer.php';
        break;

    case 'exam_update':
        require_once __DIR__ . '/../app/controllers/ExamController.php';
        $controller = new ExamController();
        $controller->updateExam();
        break;

    case 'exam_delete':
        require_once __DIR__ . '/../app/controllers/ExamController.php';
        $controller = new ExamController();
        $controller->deleteExam();
        break;

    case 'library-officer':
        require_once __DIR__ . '/../app/controllers/BookController.php';
        $controller = new BookController();
        $books = $controller->index();
        require_once __DIR__ . '/../app/views/libraryofficer_dashboard.php';
        break;

    case 'book_create':
        require_once __DIR__ . '/../app/controllers/BookController.php';
        $controller = new BookController();
        $controller->createBook();
        break;

    case 'book_update':
        require_once __DIR__ . '/../app/controllers/BookController.php';
        $controller = new BookController();
        $controller->updateBook();
        break;

    case 'book_delete':
        require_once __DIR__ . '/../app/controllers/BookController.php';
        $controller = new BookController();
        $controller->deleteBook();
        break;

    case 'library-archived':
        require_once __DIR__ . '/../app/controllers/BookController.php';
        $controller = new BookController();
        $books = $controller->archived();
        require_once __DIR__ . '/../app/views/libraryofficer_archived.php';
        break;

    case 'book_restore':
        require_once __DIR__ . '/../app/controllers/BookController.php';
        $controller = new BookController();
        $controller->restoreBook();
        break;

    case 'finance-officer':
        
        require_once __DIR__ . '/../app/views/financeofficer_dashboard.php';
        break;

    default:
        echo "404 Page Not Found";
}
?>