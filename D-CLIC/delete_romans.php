<?php
include 'connexion.php';

$sql = "DELETE FROM livres WHERE categorie = 'Romans historiques'";

if ($conn->query($sql) === TRUE) {
    echo "Suppression réussie. " . $conn->affected_rows . " livre(s) supprimé(s).";
} else {
    echo "Erreur: " . $conn->error;
}

$conn->close();
?>