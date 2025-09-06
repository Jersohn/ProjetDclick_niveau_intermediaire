<?php
include 'connexion.php';

$sql = "SELECT * FROM livres WHERE auteur = 'Jules Verne'";
$result = $conn->query($sql);

echo "<h2>Livres de Jules Verne</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Titre</th><th>Image</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["titre"] . "</td>";
        echo "<td><img src='" . $row["image"] . "' width='100' alt='" . $row["titre"] . "'></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucun livre trouvé pour cet auteur.";
}

$conn->close();
?>