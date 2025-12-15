<?php
class RegisterController {
    public function showRegisterForm() {
        require_once __DIR__ . '/../views/register.php';
    }
    public function handleRegistration() {

        
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

        require_once __DIR__ . '/../../config/database.php';

        $fullname = $_POST['fullname'];
        $email    = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $mobile   = $_POST['mobilenumber'];
        $address  = $_POST['address'];
        $role     = $_POST['role'];

        $stmt = $connection->prepare(
            "INSERT INTO users (name, email, password, mobilenumber, address, role)
             VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssssss",
            $fullname, $email, $password, $mobile, $address, $role
        );

        if ($stmt->execute()) {
            header("Location: index.php?page=login");
            exit();
        } else {
            echo "DB Error: " . $stmt->error;
        }
    }
}
           
}


    

?>