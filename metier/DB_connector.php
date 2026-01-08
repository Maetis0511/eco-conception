<?php

class DB_Connector
{
    private static $connect = null;

    public function openConnexion()
    {

        if (!isset($connect)) {

            try {
                $connect = new PDO('mysql:host=localhost;dbname=scierie;charset=utf8', 'root', 'Kc0!Wr5!Ma', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_LOCAL_INFILE => true));

            } catch (PDOException $ex) {
                die('connexion echouée : ' . $ex->getMessage());
            }
        }


        return $connect;
    }

    public function closeConnexion()
    {

        if (isset($connect)) {
            $connect = null;
        }
    }
}
