<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "root";
    private $dbName = "moncomptable";
    private $connection;


    public function connect() {
        $this->connection = null;
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbName;port=3307",
            $this->user,
            $this->password);
        }
        catch(PDOException $e){
            die("Erreur: " . $e->getMessage());
        }
        
        return $this->connection;
    }


}

?>