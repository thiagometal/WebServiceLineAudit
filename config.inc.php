<?php

class Database {
    
    //Setting configuration variables
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "lineauditdb";
    public $conn;
    
    public function getConnection(){
        
        $this->conn = null;
        
        try{
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}

?>