<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

if (isset($_GET['idUtil']) || isset($_GET['mdpUtil'])) {

    $cnx = new DB_Connector();
    $jeton = $cnx->openConnexion();

    $userManager = new UserDao($jeton);
    $userId = $_GET['idUtil'];
    $mdp = $_GET['mdpUtil'];
	
    $jetonExistance = $userManager->userExist($userId, MD5($mdp));
    if ($jetonExistance) {
      $_SESSION['id'] = $userId;
         
		  $cnx->closeConnexion();
		  header('Location:../index.php');
    } else {
		  $_SESSION['errCnx'] = "La combinaison nom d'utilisateur/mot de passe est incorrecte"; 
		  $cnx->closeConnexion();
		  header('Location:../connexion.php');	
    }
}