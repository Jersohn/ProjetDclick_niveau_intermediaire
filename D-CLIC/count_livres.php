<?php
include 'connexion.php';

$sql = "SELECT COUNT(*) as total FROM livres";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo "Nombre total de livres: " . $row["total"];

$conn->close();
?>