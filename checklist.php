<?php
class Checklist{
    private $conn;
    private $table_name = "checklist";
    
    public $id;
    public $id_audit;
    public $id_item_checklist;
    public $image;
    public $status;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function post($idAudit, $idItemChecklist) {
        $query = "INSERT INTO " . $this->table_name . 
            " SET id_audit=" .$idAudit. ", id_item_checklist=" . $idItemChecklist;
            
        $stmt = $this->conn->prepare($query);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    function getList() {
        $query = "SELECT c.*, i.* FROM " . $this->table_name . "as c
                  INNER JOIN item_checklist as i ON c.id_item_checklist = i.id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
} 
?>
