<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = intval($data['id']);
    $titre = $conn->real_escape_string($data['titre']);
    $auteur = $conn->real_escape_string($data['auteur']);
    $description = $conn->real_escape_string($data['description']);
    $maison_edition = $conn->real_escape_string($data['maison_edition']);
    $nombre_exemplaire = intval($data['nombre_exemplaire']);

    $sql = "UPDATE Livres SET 
            titre = '$titre', 
            auteur = '$auteur', 
            description = '$description', 
            maison_edition = '$maison_edition', 
            nombre_exemplaire = $nombre_exemplaire 
            WHERE id = $id";

    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Livre modifié avec succès'
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