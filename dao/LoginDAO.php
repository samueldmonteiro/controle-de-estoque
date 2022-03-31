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
				$passwordHash = $stmt->fetch()['password'];

				if(password_verify($password, $passwordHash)){
					return true;
				}
			}else{
				return false;
			}

		}
	}


?>