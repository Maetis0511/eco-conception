<?php

$con = mysqli_connect("localhost", "root", "Kc0!Wr5!Ma", "scierie");

if (mysqli_connect_errno()) {
    echo "Erreur de connexion: " . mysqli_connect_error();
}

mysqli_set_charset($con, "utf8");

$sql = "SELECT home.titre, home.descr, home.img FROM home";

if (!mysqli_query($con, $sql)) {
    echo "Création échouée" . mysqli_error($con);
}

$requete = $con->query($sql);

echo '<div class="container my-4">';

while ($resultat = mysqli_fetch_array($requete)) {
    echo '<div class="row mb-5 align-items-center border-bottom pb-4">';

    if ($resultat['titre'] != '') {
        echo '<div class="col-12 mb-3 text-center">';
        echo '  <h2 class="font-weight-bold">' . $resultat['titre'] . '</h2>';
        echo '</div>';
    }

    if ($resultat['descr'] != '' && $resultat['img'] != '') {

        echo '<div class="col-12 col-lg-6 order-2 order-lg-1">';
        echo '  <p class="text-justify">' . $resultat['descr'] . '</p>';
        echo '</div>';

        echo '<div class="col-12 col-lg-6 order-1 order-lg-2 mb-3 mb-lg-0 text-center">';
        echo '  <img src="images/' . $resultat['img'] . '" loading="lazy" class="img-fluid rounded shadow" alt="Image">';
        echo '</div>';

    } else {
        if ($resultat['descr'] != '') {
            echo '<div class="col-12">';
            echo '  <p>' . $resultat['descr'] . '</p>';
            echo '</div>';
        }
        if ($resultat['img'] != '') {
            echo '<div class="col-12 text-center">';
            echo '  <img src="images/' . $resultat['img'] . '" loading="lazy" class="img-fluid rounded shadow" alt="Image">';
            echo '</div>';
        }
    }

    echo '</div>';
}

echo '</div>';

mysqli_close($con);
?>