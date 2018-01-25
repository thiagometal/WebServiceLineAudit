<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config.inc.php';
include_once 'audit.php';
include_once 'itemChecklist.php';
    
$database = new Database();
$db = $database->getConnection();

$audit = new Audit($db);
$itemChecklist = new ItemChecklist();

$data = json_decode(file_get_contents("php://input"));

$audit->id_user = $_POST["id_user"];
$audit->status = $_POST["status"];
$audit->total_score = $_POST["total_score"];
$audit->line = $_POST["line"];
$audit->date = $_POST["date"];

if ($audit->post()) {
    echo '{';
        echo '"message": "Audit was created."';
    echo '}';
    $idAudit = $audit->getLastId();
    $itensForChecklist = $itemChecklist->getListItemByLine($audit->line);
} else {
    echo '{';
        echo '"message": "Unable to create Audit."';
    echo '}';
}
?>	