<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lineauditdb";

try {
    	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password
    	);

    	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
catch(PDOException $e)

    {
    	die("Lamento, algo não está funcionando 100% (DB) ");
    }

?>