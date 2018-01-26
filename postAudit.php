<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config.inc.php';
include_once 'audit.php';
include_once 'itemChecklist.php';
include_once 'checklist.php';
    
$database = new Database();
$db = $database->getConnection();

$itemChecklist = new ItemChecklist($db);

$audit = new Audit($db);
$itemChecklist = new ItemChecklist($db);
$checklist = new $Checklist($db);

$itensForChecklist = array();

$data = json_decode(file_get_contents("php://input"));

$audit->id_user = $_POST["id_user"];
$audit->status = $_POST["status"];
$audit->total_score = $_POST["total_score"];
$audit->line = $_POST["line"];

if ($audit->post()) {
    echo '{';
        echo '"message": "Audit was created."';
    echo '}';
    
    $idAudit = $audit->getLastId();
    $itensForChecklist = $itemChecklist->getListItemByLine($audit->line);
    
    $num = $itensForChecklist->rowCount();

    if ($num>0) {
        $itemForChecklist_arr = array();

        while ($row = $itensForChecklist->fetch(PDO::FETCH_ASSOC)) {
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

            array_push($itemForChecklist_arr, $itemChecklist_item);
        }
        
        $countChecklistError = 0;
        $countChecklistOk = 0;
        
        foreach ($itemForChecklist_arr as $item) {
            if ($idAudit, $Checklist->post($item["id"])) {
                $countChecklistOk++;        
            } else { 
                $countChecklistError++;
            }
        }
        echo '{';
            echo '"message": ' . $countChecklistOk . '" Itens inseridos no Checklist da Auditoria."' . $countChecklistError . " Não foi possível cadastrar.";
        echo '}';
    } 
} else {
    echo '{';
        echo '"message": "Unable to create Audit."';
    echo '}';
}
?>	