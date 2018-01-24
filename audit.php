<?php
class Audit{
    private $conn;
    private $table_name = "audit";
    
    public $id;
    public $status;
    public $total_score;
    public $line;
    public $id_user;
    public $date;
    
    public function __construct($db){
        $this->conn = $db;
    }
} 
?>
