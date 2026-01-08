<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

if (isset($_POST['idUtilCreation']) || isset($_POST['pwdCreation']) || isset($_POST['pwdBis'])) {

    $cnx = new DB_Connector();
    $jeton = $cnx->openConnexion();

    $userManager = new UserDao($jeton);

    $id = trim($_POST['idUtilCreation']);
    $pwd = trim($_POST['pwdCreation']);
    $pwdBis = trim($_POST['pwdBis']);

    $regexMdp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    if (($userManager->idExist($id))) {
        $_SESSION['errId'] = "Cet identifiant est déjà utilisé";
        $cnx->closeConnexion();
        header('Location:../connexion.php');
        exit();
    } else {

        if ($pwd != $pwdBis) {
            $_SESSION['errMdp'] = "Les mots de passe ne sont pas identiques.";
            $cnx->closeConnexion();
            header('Location:../connexion.php');
            exit();

        } elseif (!preg_match($regexMdp, $pwd)) {
            $_SESSION['errMdp'] = "Le mot de passe doit faire 8 caractères min. avec majuscule, minuscule, chiffre et caractère spécial.";
            $cnx->closeConnexion();
            header('Location:../connexion.php');
            exit();

        } else {
            $newUser = new User([
                'userId' => $id,
                'userPwd' => $pwd,
            ]);

            if ($userManager->add($newUser)) {
                $_SESSION['creationOk'] = "Nouvel utilisateur créé avec succès !";
                $cnx->closeConnexion();
                header('Location:../connexion.php');
                exit();
            } else {
                $_SESSION['creationNok'] = "Erreur : Utilisateur non créé.";
                $cnx->closeConnexion();
                header('Location:../connexion.php');
                exit();
            }
        }
    }
}
?>