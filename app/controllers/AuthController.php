<?php
session_start();
require_once __DIR__ . '/../models/User.php';

if(isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $userModel = new User();
    $user = $userModel->verifyPassword($email, $password);

    if($user && $user['role'] === 'admin') {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['name'];
        header('Location: ../views/admin/dashboard.php');
        exit;
    } else {
        $error = "Invalid email or password";
        header("Location: ../../public/login.php?error=" . urlencode($error));
        exit;
    }
}

// Logout
if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../../public/login.php');
    exit;
}
