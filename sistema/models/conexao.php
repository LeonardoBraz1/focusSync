<?php

date_default_timezone_set('America/Sao_Paulo');

class ConexaoPool {
    private static $pool = [];
    private static $maxConnections = 25;
    private static $minConnections = 5;
    private static $inactiveTime = 10;

    private function __construct() {
        // Configurações de conexão com o banco de dados
        $host = 'focus10g1.c5ghkeidia9i.us-east-2.rds.amazonaws.com';
        $db = 'dbfocus10g';
        $user = 'admin';
        $pass = '99664191';

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        // Abre o número mínimo de conexões inicialmente
        for ($i = 0; $i < self::$minConnections; $i++) {
            try {
                $conn = new PDO($dsn, $user, $pass);
                self::$pool[] = [
                    'connection' => $conn,
                    'lastUsed' => time(),
                    'isReserved' => false
                ];
            } catch (PDOException $e) {
                header("Location: ../views/erro.html");
                exit;
            }
        }
    }

    public static function getConnection() {
        static $instance = null;

        if ($instance === null) {
            $instance = new self();
        }

        // Procura uma conexão disponível no pool
        foreach (self::$pool as &$connectionInfo) {
            if (!$connectionInfo['isReserved']) {
                $connectionInfo['isReserved'] = true;
                $connectionInfo['lastUsed'] = time();
                return $connectionInfo['connection'];
            }
        }

        // Caso não haja conexões disponíveis, cria uma nova conexão
        if (count(self::$pool) < self::$maxConnections) {
            $conn = self::createConnection();
            $conn['lastUsed'] = time();
            $conn['isReserved'] = true;
            self::$pool[] = $conn;

            return $conn['connection'];
        }

        // Caso o pool já esteja no limite máximo de conexões
        throw new Exception('Limite máximo de conexões atingido.');
    }

    public static function releaseConnection($conn) {
        foreach (self::$pool as &$connectionInfo) {
            if ($connectionInfo['connection'] === $conn) {
                $connectionInfo['isReserved'] = false;
                $connectionInfo['lastUsed'] = time();
                break;
            }
        }
    }

    private static function createConnection() {
        $host = 'focus10g1.c5ghkeidia9i.us-east-2.rds.amazonaws.com';
        $db = 'dbfocus10g';
        $user = 'admin';
        $pass = '99664191';

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        try {
            $conn = new PDO($dsn, $user, $pass);
            return [
                'connection' => $conn,
                'lastUsed' => time(),
                'isReserved' => true
            ];
        } catch (PDOException $e) {
            header("Location: ../views/erro.html");
            exit;
        }
    }

    public static function checkInactiveConnections() {
        $currentTime = time();

        foreach (self::$pool as $key => &$connectionInfo) {
            $lastUsed = $connectionInfo['lastUsed'];

            if (($currentTime - $lastUsed) >= self::$inactiveTime && !$connectionInfo['isReserved']) {
                $conn = $connectionInfo['connection'];
                $conn = null;

                unset(self::$pool[$key]);
            }
        }
    }

    public static function getPoolSize() {
        return count(self::$pool);
    }

    public static function increaseMinConnections($amount) {
        for ($i = 0; $i < $amount; $i++) {
            try {
                $conn = self::createConnection();
                $conn['lastUsed'] = time();
                $conn['isReserved'] = false;
                self::$pool[] = $conn;
            } catch (PDOException $e) {
                header("Location: ../views/erro.html");
                exit;
            }
        }

        self::$minConnections += $amount;
    }
}

class Conexao {
    public static function getInstance() {
        ConexaoPool::checkInactiveConnections();

        return ConexaoPool::getConnection();
    }
}
