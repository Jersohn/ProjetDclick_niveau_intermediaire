<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Bibliotheque";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$titre = $_POST['titre'];
$auteur = $_POST['auteur'];
$annee_publication = (int)$_POST['annee_publication'];
$categorie = $_POST['categorie'];
$image = $_POST['image'];

// Préparer la requête SQL
$sql = "INSERT INTO livre (titre, auteur, annee_publication, categorie, image) VALUES ('$titre', '$auteur', $annee_publication, '$categorie', '$image')";

// Exécuter la requête
if ($conn->query($sql)) {
    echo "Nouveau livre ajouté avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}
// Fermer la connexion
$conn->close();
?>