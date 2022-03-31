<?php

	require_once("config/globals.php");

	require_once("classes/Categories.php");

	$categories = new Categories();

	if(!isset($_COOKIE['category'])){
		$categories->setInCookie('Todos');
	}

	if(isset($_POST['category'])){
		
		$category = $categories->sanitize($_POST['category']);

		if($category != $_COOKIE['category']){
			$categories->setInCookie($category);
		}
		

	}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Controle de Estoque</title>
	<link rel="stylesheet" href="<?=$BASE_URL?>css/style.css">
</head>

	<header>
		<div class="container-header">
			<h1>Controle de Estoque</h1>

			<nav>
				<ul>
					<li><a href="<?=$BASE_URL?>index.php">Home</a></li>
					<li><a href="<?=$BASE_URL?>ilogin.php">Login</a></li>

				</ul>

				<form action="<?=$BASE_URL?>iindex.php" method="POST">
					<span>Buscar por Categoria</span>
					<div>
							
						<select name="category" >
							<option value="Todos">Todos</option>
						</select>
						<input type="submit" value="Buscar">
					</div>
				</form>
			</nav>
		</div>
	</header>