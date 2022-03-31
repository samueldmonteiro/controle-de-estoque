<?php

	class Categories{


		public function sanitize($category){

			$category = strip_tags($category);
			$category = filter_var($category, FILTER_SANITIZE_STRING);
			$category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$category = addslashes($category);

			return $category;
		}

		

		public function setInCookie($category){

			$expire = time() + ( 60 * 60 * 24 * 30 );
			setcookie('category', $category, $expire);

			header('Location: index.php');
			exit;
		}
	}

?>