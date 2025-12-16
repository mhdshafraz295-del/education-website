<?php
session_start();
require_once '../../config/database.php';


header('Content-Type: application/json');


$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $role = $_POST['role'] ?? '';
    
    
    $errors = [];
    
    
    if (empty($fullname)) {
        $errors['fullname'] = 'Full name is required';
    } elseif (strlen($fullname) < 2) {
        $errors['fullname'] = 'Full name must be at least 2 characters';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
        $errors['fullname'] = 'Full name can only contain letters and spaces';
    }
    
    
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    } else {
        
        $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors['email'] = 'Email already registered';
        }
        $stmt->close();
    }
    
    
    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (strlen($username) < 3) {
        $errors['username'] = 'Username must be at least 3 characters';
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $errors['username'] = 'Username can only contain letters, numbers, and underscores';
    } else {
        
        $stmt = $connection->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors['username'] = 'Username already taken';
        }
        $stmt->close();
    }
    
    
    if (!empty($phone) && !preg_match("/^[+]?[0-9\s\-()]+$/", $phone)) {
        $errors['phone'] = 'Invalid phone number format';
    }
    
    
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $password)) {
        $errors['password'] = 'Password must contain at least one uppercase letter, one lowercase letter, and one number';
    }
    
    
    if (empty($confirm_password)) {
        $errors['confirm_password'] = 'Please confirm your password';
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }
    
    
    $allowed_roles = ['student', 'lecturer', 'examination_officer', 'library_officer', 'admin'];
    if (empty($role)) {
        $errors['role'] = 'Please select a role';
    } elseif (!in_array($role, $allowed_roles)) {
        $errors['role'] = 'Invalid role selected';
    }
    

    if (!empty($errors)) {
        $response['errors'] = $errors;
        $response['message'] = 'Please fix the errors and try again';
        
        
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            $_SESSION['register_errors'] = $errors;
            $_SESSION['register_data'] = $_POST;
            header('Location: ../views/register.php');
            exit();
        }
        
        echo json_encode($response);
        exit();
    }
    

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    
    $user_id = generateUserId($role, $connection);
    

    mysqli_begin_transaction($connection);
    
    try {
        
        $stmt = $connection->prepare("INSERT INTO users (user_id, fullname, username, email, phone, password, address, role, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active', NOW())");
        $stmt->bind_param("ssssssss", $user_id, $fullname, $username, $email, $phone, $hashed_password, $address, $role);
        
        if ($stmt->execute()) {
            $insert_id = $stmt->insert_id;
            $stmt->close();
            
            
            createRoleSpecificRecord($insert_id, $role, $fullname, $email, $connection);
            
    
            mysqli_commit($connection);
            
            
            $response['success'] = true;
            $response['message'] = 'Registration successful! Redirecting to login...';
            $response['redirect'] = '../views/login.php';
            
            
            $_SESSION['registration_success'] = true;
            $_SESSION['registered_email'] = $email;
            
            
            logActivity($insert_id, 'User registered', $connection);
            
            
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || 
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
                header('Location: ../views/login.php?registered=1');
                exit();
            }
            
        } else {
            throw new Exception('Failed to create user account');
        }
        
    } catch (Exception $e) {
        
        mysqli_rollback($connection);
        
        $response['message'] = 'Registration failed: ' . $e->getMessage();
        
        
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            $_SESSION['register_error'] = $response['message'];
            header('Location: ../views/register.php');
            exit();
        }
    }
    
    echo json_encode($response);
    exit();
    
} else {
    
    header('Location: ../views/register.php');
    exit();
}


function generateUserId($role, $connection) {
    $prefix = '';
    
    switch ($role) {
        case 'student':
            $prefix = 'STU';
            break;
        case 'lecturer':
            $prefix = 'LEC';
            break;
        case 'examination_officer':
            $prefix = 'EXM';
            break;
        case 'library_officer':
            $prefix = 'LIB';
            break;
        case 'admin':
            $prefix = 'ADM';
            break;
        default:
            $prefix = 'USR';
    }
    
    
    $query = "SELECT user_id FROM users WHERE user_id LIKE '{$prefix}%' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $last_id = $row['user_id'];
        $number = intval(substr($last_id, 3)) + 1;
    } else {
        $number = 1;
    }
    
    return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
}


function createRoleSpecificRecord($user_id, $role, $fullname, $email, $connection) {
    switch ($role) {
        case 'student':
            
            $stmt = $connection->prepare("INSERT INTO students (user_id, student_name, email, enrollment_date, status) VALUES (?, ?, ?, NOW(), 'active')");
            $stmt->bind_param("iss", $user_id, $fullname, $email);
            $stmt->execute();
            $stmt->close();
            break;
            
        case 'lecturer':
    
            $stmt = $connection->prepare("INSERT INTO lecturers (user_id, lecturer_name, email, hire_date, status) VALUES (?, ?, ?, NOW(), 'active')");
            $stmt->bind_param("iss", $user_id, $fullname, $email);
            $stmt->execute();
            $stmt->close();
            break;
            
        case 'examination_officer':
    
            $stmt = $connection->prepare("INSERT INTO examination_officers (user_id, officer_name, email, hire_date, status) VALUES (?, ?, ?, NOW(), 'active')");
            $stmt->bind_param("iss", $user_id, $fullname, $email);
            $stmt->execute();
            $stmt->close();
            break;
            
        case 'library_officer':
            
            $stmt = $connection->prepare("INSERT INTO library_officers (user_id, officer_name, email, hire_date, status) VALUES (?, ?, ?, NOW(), 'active')");
            $stmt->bind_param("iss", $user_id, $fullname, $email);
            $stmt->execute();
            $stmt->close();
            break;
    }
}


 

function logActivity($user_id, $activity, $connection) {
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    
    $stmt = $connection->prepare("INSERT INTO activity_logs (user_id, activity, ip_address, user_agent, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isss", $user_id, $activity, $ip_address, $user_agent);
    $stmt->execute();
    $stmt->close();
}


mysqli_close($connection);
?>
