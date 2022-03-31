<?php

	require_once("models/Category.php");

	class CategoryDAO{

		private $pdo;

		public function __construct(PDO $pdo){
			$this->pdo = $pdo;
		}

		public function returnAll(){

			$stmt = $this->pdo->query('SELECT * FROM categories');

			$stmt->execute();

			$categories = $stmt->fetchAll();

			$returnCategories = [];

			foreach ($categories as $category) {
				$newCategory =  new Category();
				$newCategory->setCategory($category['category']);

				$returnCategories[] = $newCategory;
			}

			return $returnCategories;
		}
	}


?>