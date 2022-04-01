<?php


	require_once('templates/header.php');
	require_once("dao/LoginDAO.php");


	if(isset($_SESSION['logged'])){
		header("Location: $BASE_URL");
		exit;
	}

	$msg = null;
	
	if(isset($_POST['email']) && isset($_POST['password'])){


		if($_POST['email'] == "" || $_POST['password'] == ""){
			$msg = 'Preencha todos os Campos!';
		}else{

			$newLogin = new Login();
			$loginDAO = new LoginDAO($pdo);

			$newLogin->setEmail($_POST['email']);
			$newLogin->setPassword($_POST['password']);


			$result = $loginDAO->login($newLogin);

			if(!$result){
				$msg = "Email ou Senha Inválidos!";
			}else{
				header("Location: $BASE_URL");
				exit;
			}
		}
	}

?>

<div class="container">
	<form method="POST" action="<?=$BASE_URL?>login.php" class="login">
			<h1>Login</h1>

			<?php if($msg):?>
				<span class="msg"><?=$msg?></span>
			<?php endif?>
			
			<input type="text" name="email" placeholder="Seu Email">

			<input type="password" name="password" placeholder="Sua Senha">

			<input type="submit" value="Login">

	</form>
</div>

<?php require_once("templates/footer.php")?>