<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $nom = $conn->real_escape_string($data['nom']);
    $prenom = $conn->real_escape_string($data['prenom']);
    $email = $conn->real_escape_string($data['email']);
    $password = $conn->real_escape_string($data['password']);

    // Vérifier si l'email existe déjà
    $check_sql = "SELECT id FROM Lecteurs WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Cet email est déjà utilisé'
        ]);
    } else {
        // Insérer le nouvel utilisateur
        $sql = "INSERT INTO Lecteurs (nom, prenom, email, password) 
                VALUES ('$nom', '$prenom', '$email', '$password')";

        if ($conn->query($sql)) {
            echo json_encode([
                'success' => true,
                'message' => 'Utilisateur créé avec succès'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Erreur lors de la création: ' . $conn->error
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