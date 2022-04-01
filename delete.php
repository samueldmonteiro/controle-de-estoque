<?php

	require_once("templates/header.php");

	if(!isset($_SESSION['logged'])){
		header("Location: $BASE_URL");
		exit;
	}


	if(isset($_GET['id'])){

		
		$productDAO = new productDAO($pdo);
		$sanitize = new Sanitize();

		$id = $sanitize->sanitizeId($_GET['id']);

		$productDAO->delete($id);

		header("Location: $BASE_URL");
		exit;

	}else{
		header("Location: $BASE_URL");
		exit;
	}

?>