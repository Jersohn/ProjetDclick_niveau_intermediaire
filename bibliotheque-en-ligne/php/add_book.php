<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $titre = $conn->real_escape_string($data['titre']);
    $auteur = $conn->real_escape_string($data['auteur']);
    $description = $conn->real_escape_string($data['description']);
    $maison_edition = $conn->real_escape_string($data['maison_edition']);
    $nombre_exemplaire = intval($data['nombre_exemplaire']);

    $sql = "INSERT INTO Livres (titre, auteur, description, maison_edition, nombre_exemplaire) 
            VALUES ('$titre', '$auteur', '$description', '$maison_edition', $nombre_exemplaire)";

    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Livre ajouté avec succès'
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