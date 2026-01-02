<?php
function isAdmin() {
    return isset($_SESSION['admin_id']);
}

function requireAdmin() {
    if(!isAdmin()) {
        header('Location: ../../public/login.php');
        exit;
    }
}
