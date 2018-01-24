<?php
class CounterMeasure{
    private $conn;
    private $table_name = "counter_measure";
    
    public $id;
    public $description;
    public $id_item_checklist;
    public $image;
    public $status;
    public $answer;
    
    public function __construct($db){
        $this->conn = $db;
    }
} 
?>
