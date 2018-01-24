<?php
class User{
    private $conn;
    private $table_name = "user";
    
    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $line;
    public $category;
    
    public function __construct($db){
        $this->conn = $db;
    }
} 
?>
