<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $book_id = $conn->real_escape_string($data['book_id']);
    $user_id = $conn->real_escape_string($data['user_id']);
    $date_emprunt = date('Y-m-d');

    // Vérifier si le livre est déjà dans la liste de lecture
    $check_sql = "SELECT id FROM Liste_Lecture WHERE id_livre = $book_id AND id_lecteur = $user_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Ce livre est déjà dans votre liste de lecture'
        ]);
    } else {
        // Ajouter à la liste de lecture
        $sql = "INSERT INTO Liste_Lecture (id_livre, id_lecteur, date_emprunt) 
                VALUES ($book_id, $user_id, '$date_emprunt')";

        if ($conn->query($sql)) {
            echo json_encode([
                'success' => true,
                'message' => 'Livre ajouté à votre liste de lecture'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Erreur: ' . $conn->error
            ]);
        }
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée'
    ]);
}

$conn->close();
?>