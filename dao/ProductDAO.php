<?php

	require_once("models/Product.php");


	class ProductDAO implements ProductDAOInterface{

		private $pdo;

		public function __construct(PDO $pdo){
			$this->pdo = $pdo;
		}
		public function create(Product $product){

		}
		
		public function update(Product $product){}

		public function returnAll($filter){

			if($filter == null){
				$stmt = $this->pdo->query("SELECT * FROM estoque");

				$stmt->execute();
			}

			$data = $stmt->fetchAll();

			$products = [];

			foreach($data as $product){

				$newProduct = new Product();
				$newProduct->setId($product['id']);
				$newProduct->setName($product['name']);
				$newProduct->setDescription($product['description']);
				$newProduct->setPrice($product['price']);
				$newProduct->setImg($product['img']);
				$newProduct->setQt($product['qt']);
				$newProduct->setCategory($product['category']);

				$products[] = $newProduct;
			}

			return $products;
		}

		public function returnById($id){}
		public function delete($id){}

	}


?>