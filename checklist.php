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
} 
?>
