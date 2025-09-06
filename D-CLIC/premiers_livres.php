<?php
include 'connexion.php';

$sql = "SELECT titre FROM livres ORDER BY titre ASC LIMIT 5";
$result = $conn->query($sql);

echo "<h2>Les 5 premiers livres par ordre alphabétique</h2>";

if ($result->num_rows > 0) {
    echo "<ol>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["titre"] . "</li>";
    }
    echo "</ol>";
} else {
    echo "Aucun livre trouvé";
}

$conn->close();
?>