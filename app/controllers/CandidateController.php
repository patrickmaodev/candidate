<?php
require_once __DIR__ . '/../models/Candidate.php';

$candidateModel = new Candidate();

// Handle candidate registration
if(isset($_POST['register'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    
    // Handle CV upload
    $cvPath = null;
    if(isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
        $uploadsDir = '../../public/uploads/';
        if(!is_dir($uploadsDir)) mkdir($uploadsDir, 0777, true);

        $cvFile = $_FILES['cv'];
        $cvPath = $uploadsDir . time() . '_' . basename($cvFile['name']);
        move_uploaded_file($cvFile['tmp_name'], $cvPath);
    }

    $data = [
        'full_name' => $full_name,
        'email' => $email,
        'phone' => $phone,
        'cv' => $cvPath
    ];

    $id = $candidateModel->create($data);
    if($id) {
        header('Location: ../../public/index.php?success=1');
        exit;
    } else {
        echo "Error registering candidate.";
    }
}

// Update candidate status (admin action)
if(isset($_POST['update_status'])) {
    $candidateId = $_POST['candidate_id'];
    $status = $_POST['status'];
    $candidateModel->updateStatus($candidateId, $status);
    header('Location: ../../public/dashboard.php');
    exit;
}
