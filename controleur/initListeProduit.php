<?php
session_start();

if ((!(isset($_SESSION['id'])) || empty($_SESSION['id'])) && $_SESSION['role'] != "admin") {
    exit("Accès refusé");
}

require_once("../metier/DB_connector.php");
require_once("../metier/Produit.php");
require_once("../Dao/ProduitDao.php");

$cnx = new DB_Connector();
$jeton = $cnx->openConnexion();
$produitManager = new ProduitDao($jeton);
$produits = $produitManager->getList();

if (count($produits) > 0) {
    foreach ($produits as $prod) {
        $id = $prod->getId();
        $titre = htmlspecialchars($prod->getTitre());
        $descr = htmlspecialchars($prod->getDescr());
        $img = htmlspecialchars($prod->getImg());
        $descrShort = substr($prod->getDescr(), 0, 50) . "...";

        echo "<tr>";
        echo "  <td>$img</td>";
        echo "  <td class='font-weight-bold'>$titre</td>";
        echo "  <td>$descrShort</td>";
        echo "  <td class='text-center'>";

        echo "    <button type='button' class='btn btn-sm btn-primary btn-action btn-edit' 
                      data-id='$id' 
                      data-titre='$titre' 
                      data-descr='$descr' 
                      data-img='$img' 
                      title='Modifier'>";
        echo "      <i class='fa fa-pen'></i>";
        echo "    </button> ";

        echo "    <form method='POST' style='display:inline-block;' onsubmit=\"return confirm('Êtes-vous sûr ?');\">";
        echo "       <input type='hidden' name='idProduit' value='$id'>";
        echo "       <button type='submit' name='action' value='delete' class='btn btn-sm btn-danger btn-action' title='Supprimer'>";
        echo "         <i class='fa fa-trash'></i>";
        echo "       </button>";
        echo "    </form>";

        echo "  </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>Aucun produit trouvé.</td></tr>";
}
?>