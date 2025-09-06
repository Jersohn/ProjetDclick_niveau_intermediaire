<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque_db";

// Récupérer les données du formulaire
// if (isset($_POST['titre']))
//  {  
//      if (!empty($_POST['titre']))
//      {
//		    echo "Vous avez saisi '".$_POST['titre']."'\n" ;
//            $titre = $_POST['titre'];
//      }
//      else
//          echo "Aucune valeur saisie\n";
//  }
//  else
//      echo "Utilisation incorrecte\n" ;


$titre = $_POST['titre'];
$auteur = $_POST['auteur'];
$annee_publication = (int) $_POST['annee_publication'];
$categorie = $_POST['categorie'];
$image = $_POST['image'];
echo "Le titre du livre est : $titre";
echo "Le nom de l'auteur est : $auteur";
echo "L'année de publication est : $annee_publication";
echo "La catégorie du livre est :  $categorie";
echo "Le nom de l'image est : $image";



// ******** Intégration de Javascript dans PHP ********************
//echo "<script language='javascript' >";
//echo "	alert ('Le titre du livre est : $titre')";
//echo "</script>"



?>