<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque_en_ligne";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Définir l'encodage des caractères
$conn->set_charset("utf8");
?>