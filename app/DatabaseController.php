<?php

namespace App;
use \PDO;
use \PDOException;
class DatabaseController
{
    protected $conn;
    protected $return;

    private $host = "localhost:3307";
    private $database = "rocnikovy";
    private $user = "root";
    private $password = "";

    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    );

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->user, $this->password, $this->options);
        } catch (PDOException $e) {
            echo "Connection failed:" . $e->getMessage();
        }
    }

    public function openConnection()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}