<?php 


	require_once("templates/header.php");

	if(!isset($_SESSION['logged'])){
		header('Location: '. $BASE_URL);
		exit;
	}

	if(isset($_GET['logout'])){
		session_unset();
		$_SESSION = [];
		session_destroy();
		header("Location: $BASE_URL");
		exit;
	}


?>


<div class="container">

	<div class="controls-manager">
			
			<ul>
				<li><a href="<?=$BASE_URL?>create.php">Cadastrar Produto</a></li>
				<li><a href="?logout">Logout</a></li>
				<li><a href="#">Produtos em Falta</a></li>
			</ul>
	</div>

</div>

<?php require_once("templates/footer.php")?>