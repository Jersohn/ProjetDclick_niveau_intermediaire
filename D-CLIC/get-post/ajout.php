<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Livre</title>
</head>
<body>
    <h1>Ajouter un Livre</h1>
    <form action="ajouter_livre.php" method="post">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br><br>
        
        <label for="auteur">Auteur :</label>
        <input type="text" id="auteur" name="auteur" required><br><br>
        
        <label for="annee_publication">Année de Publication :</label>
        <input type="number" id="annee_publication" name="annee_publication" required><br><br>
        
        <label for="categorie">Catégorie :</label>
        <input type="text" id="categorie" name="categorie" required><br><br>
        
        <label for="image">Image :</label>
        <input type="text" id="image" name="image"><br><br>
        
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>