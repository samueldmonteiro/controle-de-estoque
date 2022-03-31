<?php

	$host = 'localhost';
	$db = 'produtos';
	$user = 'samsepiol';
	$pass = 't00r';


	try{
		$pdo = new PDO("mysql:host=$host;dbname=$db",$user, $pass);
	}catch(PDOException $e){
		echo "erro ao conectar! ". $e->getMessage();
	}


?>