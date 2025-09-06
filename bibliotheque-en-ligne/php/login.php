<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $email = $conn->real_escape_string($data['email']);
    $password = $data['password'];

    $sql = "SELECT * FROM Lecteurs WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            echo json_encode([
                'success' => true,
                'user_id' => $user['id'],
                'message' => 'Connexion réussie'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Mot de passe incorrect'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Aucun utilisateur trouvé avec cet email'
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