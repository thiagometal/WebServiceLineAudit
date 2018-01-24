<?php
class ItemChecklist{
    private $conn;
    private $table_name = "item_checklist";
    
    public $id;
    public $section;
    public $item;
    public $detail;
    public $specification;
    public $line;
    public $weight;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function getList() {
        $query = "SELECT * FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    function post() {
        $query = "INSERT INTO " . $this->table_name . 
            " SET section=:section, item=:item, detail=:detail, specification=:specification, line=:line, weight=:weight";
            
        $stmt = $this->conn->prepare($query);
        
        $this->section = htmlspecialchars(strip_tags($this->section));
        $this->item = htmlspecialchars(strip_tags($this->item));
        $this->detail = htmlspecialchars(strip_tags($this->detail));
        $this->specification = htmlspecialchars(strip_tags($this->specification));
        $this->line = htmlspecialchars(strip_tags($this->line));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        
        $stmt->bindParam(":section", $this->section, PDO::PARAM_STR);
        $stmt->bindParam(":item", $this->item, PDO::PARAM_STR);
        $stmt->bindParam(":detail", $this->detail, PDO::PARAM_STR);
        $stmt->bindParam(":specification", $this->specification, PDO::PARAM_STR);
        $stmt->bindParam(":line", $this->line, PDO::PARAM_STR);
        $stmt->bindParam(":weight", $this->weight, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    function update() {
        $query = "UPDATE " . $this->table_name . 
            " SET section=:section, item=:item, detail=:detail, specification=:specification, line=:line, weight=:weight 
                WHERE id =:id";
            
        $stmt = $this->conn->prepare($query);
        
        $this->section = htmlspecialchars(strip_tags($this->section));
        $this->item = htmlspecialchars(strip_tags($this->item));
        $this->detail = htmlspecialchars(strip_tags($this->detail));
        $this->specification = htmlspecialchars(strip_tags($this->specification));
        $this->line = htmlspecialchars(strip_tags($this->line));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":section", $this->section, PDO::PARAM_STR);
        $stmt->bindParam(":item", $this->item, PDO::PARAM_STR);
        $stmt->bindParam(":detail", $this->detail, PDO::PARAM_STR);
        $stmt->bindParam(":specification", $this->specification, PDO::PARAM_STR);
        $stmt->bindParam(":line", $this->line, PDO::PARAM_STR);
        $stmt->bindParam(":weight", $this->weight, PDO::PARAM_STR);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    function delete() {
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
} 
?>
