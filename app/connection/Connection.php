<?php
require_once(__DIR__ . "/../util/Config.php");

class Connection {

    public static function getConn() {
        $conn = new Connection();
        return $conn->getConnection();
    }

    public function getConnection() {
        $str_conn = "mysql:host=". DB_HOST .";dbname=". DB_NAME;

        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); 
        
        try{ 
            $conn = new PDO($str_conn, DB_USER, DB_PASSWORD, $options);
            return $conn;
        } catch (PDOException $e) {
            echo "Falha ao conectar na base de dados: " . $e->getMessage();
        }
    }

}