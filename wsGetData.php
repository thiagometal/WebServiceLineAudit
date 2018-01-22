<?php

// APK WebService CRUD
// https://goo.gl/rzDX37

ini_set('default_charset', 'utf-8');

require_once('config.inc.php');
     	  
$sql = 'SELECT * FROM `item`';

$statement = $connection->prepare($sql);

$statement->execute();

if($statement->rowCount()) {
  $row_all = $statement->fetchall(PDO::FETCH_ASSOC);

  header('Content-type: application/json');

  echo json_encode($row_all);
          		
} elseif (!$statement->rowCount()) {
  echo "sem linhas";
}

		  		  		 
?>
	