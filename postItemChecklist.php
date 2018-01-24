<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config.inc.php';
include_once 'itemChecklist.php';
    
$database = new Database();
$db = $database->getConnection();

$itemChecklist = new ItemChecklist($db);

$data = json_decode(file_get_contents("php://input"));

$itemChecklist->section = $_POST["section"];
$itemChecklist->item = $_POST["item"];
$itemChecklist->detail = $_POST["detail"];
$itemChecklist->specification = $_POST["specification"];
$itemChecklist->line = $_POST["line"];
$itemChecklist->weight = $_POST["weight"];

if ($itemChecklist->post()) {
    echo '{';
        echo '"message": "Checklist Item was created."';
    echo '}';
} else {
    echo '{';
        echo '"message": "Unable to create Checklist Item."';
    echo '}';
}
?>	