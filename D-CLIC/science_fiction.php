<?php
include 'connexion.php';

$sql = "SELECT * FROM livres WHERE categorie = 'Science-fiction'";
$result = $conn->query($sql);

echo "<h2>Livres de Science-fiction</h2>";

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["titre"] . " - Fichier image: " . $row["image"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucun livre trouvé dans cette catégorie.";
}

$conn->close();
?>