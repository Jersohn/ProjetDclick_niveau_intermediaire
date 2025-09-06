<?php
include 'config.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $book_id = $conn->real_escape_string($_GET['id']);

    $sql = "SELECT * FROM Livres WHERE id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        echo json_encode($book);
    } else {
        echo json_encode(['error' => 'Livre non trouvé']);
    }
} else {
    echo json_encode(['error' => 'ID non spécifié']);
}

$conn->close();
?>