<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once 'config.inc.php';
include_once 'checklist.php';

$database = new Database();
$db = $database->getConnection();

$checklist = new Checklist($db);

$stmt = $checklist->getList();
$num = $stmt->rowCount();

if ($num>0) {
    $itemChecklist_arr = array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $itemChecklist_item = array(
            "id" => $id,
            "section" => $section,
            "item" => $item,
            "detail" => $item,
            "specification" => $specification,
            "weight" => $weight,
            "line" => $line
        );
        
        array_push($itemChecklist_arr, $itemChecklist_item);
    }
    echo json_encode($itemChecklist_arr);
} else {
    echo json_encode(array("message" => "No Item of Checklist found."));
}
		  		  		 
?>
	