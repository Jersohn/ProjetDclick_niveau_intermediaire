<?php
include 'connexion.php';

// Traitement de la mise à jour
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $new_year = $_POST['new_year'];

    $sql = "UPDATE livres SET annee_publication = $new_year WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Mise à jour réussie!";
    } else {
        echo "Erreur: " . $conn->error;
    }
}

// Affichage des données actuelles
$sql = "SELECT * FROM livres WHERE titre = 'Vingt mille lieues sous les mers'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h2>Mise à jour de l'année de publication</h2>
<form method="post">
    <p><strong>Titre:</strong> <?php echo $row["titre"]; ?></p>
    <p><strong>Auteur:</strong> <?php echo $row["auteur"]; ?></p>
    <p><strong>Année actuelle:</strong> <?php echo $row["annee_publication"]; ?></p>

    <label for="new_year">Nouvelle année:</label>
    <input type="number" name="new_year" value="<?php echo $row['annee_publication']; ?>" required>

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" name="update" value="Mettre à jour">
</form>

<?php
$conn->close();
?>