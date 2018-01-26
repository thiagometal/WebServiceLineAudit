<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once 'config.inc.php';
include_once 'itemChecklist.php';

$database = new Database();
$db = $database->getConnection();

$itemChecklist = new ItemChecklist($db);

$itemChecklist->id = isset($_GET['id']) ? $_GET['id'] : die();

$stmt = $itemChecklist->getItemById($itemChecklist->id);
$num = $stmt->rowCount();

if ($num>0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $itemChecklist->section = $row['section'];
    $itemChecklist->item = $row['item'];
    $itemChecklist->detail = $row['detail'];
    $itemChecklist->specification = $row['specification'];
    $itemChecklist->line = $row['line'];
    $itemChecklist->weight = $row['weight'];
    
    echo json_encode($itemChecklist);
} else {
    echo json_encode(array("message" => "No Item of Checklist found."));
}
		  		  		 
?>
	