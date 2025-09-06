<?php
include 'config.php';

header('Content-Type: application/json');

if (isset($_GET['user_id'])) {
    $user_id = $conn->real_escape_string($_GET['user_id']);

    $sql = "SELECT l.*, ll.id as wishlist_id, ll.date_emprunt 
            FROM Liste_Lecture ll 
            JOIN Livres l ON ll.id_livre = l.id 
            WHERE ll.id_lecteur = $user_id";

    $result = $conn->query($sql);

    $books = array();
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    echo json_encode($books);
} else {
    echo json_encode(['error' => 'User ID non spécifié']);
}

$conn->close();
?>