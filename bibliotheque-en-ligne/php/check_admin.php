<?php
include 'config.php';

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['is_admin' => false]);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($user_id == 1) {
    echo json_encode(['is_admin' => true]);
} else {
    echo json_encode(['is_admin' => false]);
}

$conn->close();
?>