<?php
class LoginController {

    public function showLoginForm() {
        
        if (isset($_GET['logout']) && $_GET['logout'] == '1') {
            if (session_status() === PHP_SESSION_NONE) session_start();
            session_unset();
            session_destroy();
            header("Location: index.php?page=login");
            exit;
        }
        require_once __DIR__ . '/../views/login.php';
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=login");
            exit;
        }

        require_once __DIR__ . '/../../config/database.php';

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            header("Location: index.php?page=login&error=empty");
            exit;
        }

        
        $stmt = $connection->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
        if (!$stmt) {
            die("Database query error");
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];

                if ($user['role'] === 'Student') {
                    header("Location: index.php?page=student-dashboard");
                } elseif ($user['role'] === 'Lecturer') {
                    header("Location: index.php?page=lecturer-dashboard");
                } else {
                    header("Location: index.php?page=dashboard");
                }
                exit;
            }
        }

        $stmt->close();
        header("Location: index.php?page=login&error=invalid");
        exit;
    }
}