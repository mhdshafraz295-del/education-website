<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

class LoginController {
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
    }
    
    
    public function index() {
        require_once __DIR__ . '/../views/login.php';
    }
    

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /education_site/public/index.php?controller=login&action=index');
            exit();
        }
        
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email and password are required";
            header('Location: /education_site/public/index.php?controller=login&action=index');
            exit();
        }
        
        
        $stmt = $this->connection->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            
            if (password_verify($password, $user['password'])) {
    
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['logged_in'] = true;
                
                $stmt->close();
                
                
                switch ($user['role']) {
                    case 'student':
                        header('Location: /education_site/app/views/student_dashboard.php');
                        break;
                    case 'financial_officer':
                        header('Location: /education_site/app/views/financeofficer_dashboard.php');
                        break;
                    case 'lecturer':
                        header('Location: /education_site/app/views/lecture_dashboard.php');
                        break;
                    case 'exam_officer':
                        header('Location: /education_site/app/views/examination_officer.php');
                        break;
                    case 'library_officer':
                        header('Location: /education_site/app/views/libraryofficer_dashboard.php');
                        break;
                    default:
                        header('Location: /education_site/app/views/student_dashboard.php');
                        break;
                }
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password";
            }
        } else {
            $_SESSION['error'] = "Invalid email or password";
        }
        
        $stmt->close();
        header('Location: /education_site/public/index.php?controller=login&action=index');
        exit();
    }
    
    
    public function logout() {
        session_destroy();
        header('Location: /education_site/public/index.php?controller=login&action=index');
        exit();
    }
    
    
    public function forgotPassword() {
        echo "Forgot password functionality - Coming soon";
    }
}


if (isset($_GET['action'])) {
    $controller = new LoginController($connection);
    $action = $_GET['action'];
    
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        $controller->index();
    }
} else {
    $controller = new LoginController($connection);
    $controller->index();
}
?>