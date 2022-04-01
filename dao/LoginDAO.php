<?php

	require_once("models/Login.php");


	class LoginDAO{

		private $pdo;


		public function __construct(PDO $pdo){
			$this->pdo = $pdo;
		}

		public function login(Login $user){

			$email = $user->getEmail();
			$password = $user->getPassword();



			$stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");

			$stmt->bindValue(":email",$email);

			$stmt->execute();

			if($stmt->rowCount() > 0){
				$user = $stmt->fetch();
				$passwordHash = $user['password'];

				if(password_verify($password, $passwordHash)){
					$_SESSION['logged'] = true;
					$_SESSION['name'] = explode("@", $email)[0];
					$_SESSION['id'] = $user['id'];
					return true;
				}
			}else{
				return false;
			}

		}
	}


?>