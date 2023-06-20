
<?php

class Conexao {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Configurações de conexão com o banco de dados
        $host = 'focus10g1.c5ghkeidia9i.us-east-2.rds.amazonaws.com';
        $db = 'dbfocus10g';
        $user = 'admin';
        $pass = '99664191';

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        try {
            $this->conn = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            header("Location: ../views/erro.html");
           
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Conexao();
        }
        return self::$instance->conn;
    }
}