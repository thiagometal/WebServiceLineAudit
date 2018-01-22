<?php
ini_set('default_charset', 'utf-8');
	
require_once('config.inc.php');
     	  
$key = $_POST['key'];
$nome = $_POST['parametroNome'];
$cidade = $_POST['parametroCidade'];
       
$sql = 'INSERT INTO   contato (nome,cidade) 
		       VALUES         (:nome,:cidade)';

$statement = $connection->prepare($sql);
          
$statement->bindParam(':nome',  $nome, PDO::PARAM_STR);
$statement->bindParam(':cidade', $cidade, PDO::PARAM_STR);

$statement->execute();
		  		  		 
?>	