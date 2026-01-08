<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/Produit.php");
require("../Dao/ProduitDao.php");

$cnx = new DB_Connector();
$dao = new ProduitDao($cnx->openConnexion());

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $dao->delete($_POST['idProduit']);
        $_SESSION['msgOk'] = "Produit supprimé avec succès.";
    }

    elseif (isset($_POST['action']) && $_POST['action'] == 'save') {

        $p = new Produit();
        $p->setTitre($_POST['lbProduit']);
        $p->setDescription($_POST['lbDescr']);
        $p->setImage($_POST['lbImg']);

        if (!empty($_POST['idProduit'])) {
            $p->setId($_POST['idProduit']);
            $dao->update($p);
            $_SESSION['msgOk'] = "Produit modifié avec succès.";
        } else {
            $dao->add($p);
            $_SESSION['msgOk'] = "Produit ajouté avec succès.";
        }
    }
}

header("Location: ../administration.php");
exit();
?>