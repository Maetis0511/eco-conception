<?php

/* Connexion à la bdd */
$con = mysqli_connect("localhost", "root", "Kc0!Wr5!Ma", "scierie");

/* Gestion des erreurs de connexion */
if (mysqli_connect_errno()){
    echo "Erreur de connexion: " . mysqli_connect_error();
}

mysqli_set_charset($con,"utf8");

/* Requête SQL */
$sql = "SELECT home.titre, home.descr, home.img FROM home";

/* Gestion des erreurs de requête sql */
if (!mysqli_query($con, $sql)){
    echo "Création échouée" . mysqli_error($con);
}

$requete = $con->query($sql);

echo '<div class="container my-4">'; // Conteneur principal avec marge

while ($resultat = mysqli_fetch_array($requete))
{
    // Début d'une section (Ligne principale)
    echo '<div class="row mb-5 align-items-center border-bottom pb-4">';

    // 1. GESTION DU TITRE (S'il existe, il prend toute la largeur)
    if($resultat['titre'] != '') {
        echo '<div class="col-12 mb-3 text-center">';
        echo '  <h2 class="font-weight-bold">' . $resultat['titre'] . '</h2>';
        echo '</div>';
    }

    // 2. GESTION DESCRIPTION + IMAGE (Le cœur du responsive)
    if($resultat['descr'] != '' && $resultat['img'] != ''){

        // COLONNE TEXTE
        // Mobile : order-2 (en bas) | PC : order-1 (à gauche)
        echo '<div class="col-12 col-lg-6 order-2 order-lg-1">';
        echo '  <p class="text-justify">' . $resultat['descr'] . '</p>';
        echo '</div>';

        // COLONNE IMAGE
        // Mobile : order-1 (en haut) | PC : order-2 (à droite)
        echo '<div class="col-12 col-lg-6 order-1 order-lg-2 mb-3 mb-lg-0 text-center">';
        echo '  <img src="images/' . $resultat['img'] . '" class="img-fluid rounded shadow" alt="Image">';
        echo '</div>';

    }
    // 3. GESTION CAS PARTICULIERS (Juste texte OU Juste image)
    else {
        if($resultat['descr'] != ''){
            echo '<div class="col-12">';
            echo '  <p>' . $resultat['descr'] . '</p>';
            echo '</div>';
        }
        if($resultat['img'] != ''){
            echo '<div class="col-12 text-center">';
            echo '  <img src="images/' . $resultat['img'] . '" class="img-fluid rounded shadow" alt="Image">';
            echo '</div>';
        }
    }

    echo '</div>'; // Fin de la row
}

echo '</div>'; // Fin du container

mysqli_close($con);
?>