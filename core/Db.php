<?php

class Db{

    public $connection;
    
    private $servername = "localhost";
    private $db = "Parking";
    private $db_username = "root";
    private $db_password = "";

    

    function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->db_username, $this->db_password);
            
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connection successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


}