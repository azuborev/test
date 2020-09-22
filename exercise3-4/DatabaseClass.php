<?php

class Database
{
    private static $_instance;
    private $db_connection;
    private $dbhost = 'localhost';
    private $dbname = 'exercise4';
    private $dbuser = 'admin';
    private $dbpass = 'azuborev';

    private function __construct()
    {
        try{
            $dsn = "mysql:dbname=" . $this->dbname . ";host=" . $this->dbhost;
            $this->db_connection = new PDO($dsn, $this->dbuser, $this->dbpass);
            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function connect()
    {
        return $this->db_connection;
    }
}

