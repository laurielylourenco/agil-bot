<?php

class Conn {
    private static $instance;
    private $conn;

    private function __construct() {
        $db_host = 'localhost'; 
        $db_name = 'agil_bot'; 
        $db_user = 'postgres';  
        $db_pass = 'lourenco';  

        try {
            $this->conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    public static function getInstance() { // singleton 
        if (!isset(self::$instance)) {
            self::$instance = new self(); // cria uma instacia da classe atual
        }
        return self::$instance; // retorna instancia 
    }

}
