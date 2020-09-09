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


    $dbh = Database::getInstance()->connect();
    // Создание таблицы
    $sql = "CREATE TABLE Students (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstName VARCHAR(30) NOT NULL,
                secondName VARCHAR(30) NOT NULL,
                age TINYINT(3) NOT NULL,
                gender ENUM('m', 'w') NOT NULL,
                phone VARCHAR(11) NOT NULL,
                email VARCHAR(50) NOT NULL,
                course VARCHAR(30) NOT NULL,
                university VARCHAR(30) NOT NULL,
                studentship INT(5) DEFAULT 0)
                ";
    $dbh->exec($sql);

