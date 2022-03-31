<?php


	class Login{

		private $id;
		private $email;
		private $password;



		public function getId(){
			return $this->id;
		}

		public function setid($id){
			$this->id = $id;
		}

		public function getEmail(){

			return $this->email;
		}

		public function setEmail($email){

			$email = strip_tags($email);
			$email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);

			$email = addslashes($email);

			$this->email = $email;
		}

		public function getPassword(){
			return $this->password;
		}

		public function setPassword($password){

			$password = strip_tags($password);
			$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

			$password = addslashes($password);
			
			$this->password = $password;
		}

	}

?>