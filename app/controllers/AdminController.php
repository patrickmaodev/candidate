<?php
session_start();
require_once __DIR__ . '/../models/Candidate.php';
require_once __DIR__ . '/../helpers/auth.php';

// Only allow admin
if(!isAdmin()) {
    header('Location: ../../public/login.php');
    exit;
}

$candidateModel = new Candidate();

// Get all candidates for dashboard
$candidates = $candidateModel->getAll();

// Load dashboard view
require_once __DIR__ . '/../../views/admin/dashboard.php';
