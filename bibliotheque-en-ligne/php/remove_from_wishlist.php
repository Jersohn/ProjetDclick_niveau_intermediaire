<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $wishlist_id = $conn->real_escape_string($data['wishlist_id']);

    $sql = "DELETE FROM Liste_Lecture WHERE id = $wishlist_id";

    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Livre retiré de votre liste de lecture'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur: ' . $conn->error
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée'
    ]);
}

$conn->close();
?>