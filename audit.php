<?php
class Audit{
    private $conn;
    private $table_name = "audit";
    
    public $id;
    public $status;
    public $total_score;
    public $line;
    public $id_user;
    public $data;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function getList() {
        $query = "SELECT * FROM " . $this->table_name . "order by id desc";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    function post() {
        $query = "INSERT INTO " . $this->table_name . 
            " SET id_user=:id_user, status=:status, total_score=:total_score, line=:line, data=:data";
            
        $stmt = $this->conn->prepare($query);
        
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->total_score = htmlspecialchars(strip_tags($this->total_score));
        $this->line = htmlspecialchars(strip_tags($this->line));
        $this->data = htmlspecialchars(strip_tags($this->data));
        $this->is_user = htmlspecialchars(strip_tags($this->is_user));
                
        $stmt->bindParam(":status", $this->status, PDO::PARAM_STR);
        $stmt->bindParam(":total_score", $this->total_score, PDO::PARAM_STR);
        $stmt->bindParam(":line", $this->line, PDO::PARAM_STR);
        $stmt->bindParam(":data", $this->date, PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $this->id_user, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    function getLastId() {
        $query = "SELECT id FROM " . $this->table_name . "order by id desc";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
} 
?>
