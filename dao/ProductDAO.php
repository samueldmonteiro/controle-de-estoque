<?php

	require_once("models/Product.php");


	class ProductDAO implements ProductDAOInterface{

		private $pdo;

		public function __construct(PDO $pdo){
			$this->pdo = $pdo;
		}

		public function create(Product $product){

			try{
				$stmt = $this->pdo->prepare("INSERT INTO estoque (name, description, price, img, qt, category) VALUES (:name, :desc, :price, :img, :qt, :cat)");

				$stmt->bindValue(':name',$product->getName());
				$stmt->bindValue(':desc',$product->getDescription());
				$stmt->bindValue(':price',$product->getPrice());
				$stmt->bindValue(':img',$product->getImg());
				$stmt->bindValue(':qt',$product->getQt());
				$stmt->bindValue(':cat',$product->getCategory());

				$stmt->execute();
			}catch(PDOException $e){
				echo $e->getMessage();
			}


		}
		
		public function update(Product $product){

			$stmt = $this->pdo->prepare("UPDATE estoque SET name=:name, description=:desc, price=:price, qt=:qt, category=:cat WHERE id=:id");

			$stmt->bindValue(':name',$product->getName());
			$stmt->bindValue(':desc',$product->getDescription());
			$stmt->bindValue(':price',$product->getPrice());
			$stmt->bindValue(':qt',$product->getQt());
			$stmt->bindValue(':cat',$product->getCategory());
			$stmt->bindValue(':id',$product->getId());



			$stmt->execute();


		}

		public function returnAll($filter, $category){


			if($category != "Todos"){
				$stmt = $this->pdo->prepare("SELECT * FROM estoque WHERE category=:cat AND name LIKE :filter");

				$stmt->bindValue(':cat',$category);
				$stmt->bindValue(':filter', "%$filter%");


				
			}elseif($category == "Todos"){

				$stmt = $this->pdo->prepare("SELECT * FROM estoque WHERE name LIKE :filter");

				$stmt->bindValue(':filter', "%$filter%");
			}

			$stmt->execute();
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

		public function returnById($id){

			$stmt = $this->pdo->prepare("SELECT * FROM estoque WHERE id=:id");

			$stmt->bindValue(':id',$id);

			$stmt->execute();

			if($stmt->rowCount() > 0){

				$data = $stmt->fetch();

				$newProduct = new Product();

				$newProduct->setId($data['id']);
				$newProduct->setName($data['name']);
				$newProduct->setDescription($data['description']);
				$newProduct->setPrice($data['price']);
				$newProduct->setImg($data['img']);
				$newProduct->setCategory($data['category']);
				$newProduct->setQt($data['qt']);


				return $newProduct;

			}else{
				return false;
			}



		}
		public function delete($id){


			$stmt = $this->pdo->prepare("DELETE FROM estoque WHERE id=:id");

			$stmt->bindValue(":id", $id);

			$stmt->execute();
		}

		public function buy($id, $qt_buy, $current_qt){


			$qt_update =  $current_qt - $qt_buy;

			if($qt_update < 0){
				$qt_update = 0;
			}

			$stmt = $this->pdo->prepare("UPDATE estoque SET qt=:qt WHERE id=:id");

			$stmt->bindValue(':qt',$qt_update);
			$stmt->bindValue(':id',$id);

			$stmt->execute();
		}

	}


?>