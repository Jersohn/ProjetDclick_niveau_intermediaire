<?php
include 'connexion.php';

$sql = "SELECT titre, auteur FROM livres";
$result = $conn->query($sql);

echo "<h2>Tous les livres</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Titre</th><th>Auteur</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["titre"] . "</td>";
        echo "<td>" . $row["auteur"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucun livre trouvé";
}

$conn->close();
?>