<?php
date_default_timezone_set('America/Sao_Paulo');

class ConexaoPool {
    private static $pool = array();
    private static $maxConnections = 25;
    private static $minConnections = 7;
    private static $inactiveTime = 10; 

    private static $lastActiveTime = 0;

    private function __construct() {
        // Configurações de conexão com o banco de dados
        $host = 'focus10g1.c5ghkeidia9i.us-east-2.rds.amazonaws.com';
        $db = 'dbfocus10g';
        $user = 'admin';
        $pass = '99664191';

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        for ($i = 0; $i < self::$minConnections; $i++) {
            try {
                $conn = new PDO($dsn, $user, $pass);
                self::$pool[] = array(
                    'connection' => $conn,
                    'lastUsed' => time()
                );
            } catch (PDOException $e) {
                header("Location: ../views/erro.html");
            }
        }
    }

    public static function getConnection() {
        if (count(self::$pool) === 0) {
            self::createConnections();
        }

        self::$lastActiveTime = time();

        $connectionInfo = array_pop(self::$pool);
        $conn = $connectionInfo['connection'];

        return $conn;
    }

    public static function releaseConnection($conn) {
        if (count(self::$pool) < self::$maxConnections) {
            self::$pool[] = array(
                'connection' => $conn,
                'lastUsed' => time()
            );
        } else {
            $conn = null;
        }
    }

    private static function createConnections() {
        for ($i = 0; $i < self::$maxConnections; $i++) {
            self::$pool[] = self::createConnection();
        }
    }

    private static function createConnection() {
        // Configurações de conexão com o banco de dados
        $host = 'focus10g1.c5ghkeidia9i.us-east-2.rds.amazonaws.com';
        $db = 'dbfocus10g';
        $user = 'admin';
        $pass = '99664191';

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        try {
            $conn = new PDO($dsn, $user, $pass);
            return array(
                'connection' => $conn,
                'lastUsed' => time()
            );
        } catch (PDOException $e) {
            header("Location: ../views/erro.html");
        }
    }

    public static function checkInactiveConnections() {
        $currentTime = time();

        foreach (self::$pool as $key => $connectionInfo) {
            $lastUsed = $connectionInfo['lastUsed'];

            if (($currentTime - $lastUsed) >= self::$inactiveTime) {
                $conn = $connectionInfo['connection'];
                $conn = null;

                unset(self::$pool[$key]);
            }
        }
    }
}

class Conexao {
    public static function getInstance() {
        ConexaoPool::checkInactiveConnections();

        return ConexaoPool::getConnection();
    }
}