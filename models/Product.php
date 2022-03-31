<?php



	class Product{
		private $id;
		private $name;
		private $description;
		private $price;
		private $img;
		private $qt;
		private $category;


		public function getId(){
			return $this->id;
		}

		public function setid($id){
			$this->id = $id;
		}

		public function getName(){
			return $this->name;
		}

		public function setName($name){
			$this->name = $name;
		}

		public function getDescription(){
			return $this->description;
		}

		public function setDescription($description){
			$this->description = $description;
		}

		public function getPrice(){
			return $this->price;
		}

		public function setPrice($price){
			$this->price = $price;
		}

		public function getImg(){
			return $this->img;
		}

		public function setImg($img){
			$this->img = $img;
		}

		public function getQt(){
			return $this->qt;
		}

		public function setQt($qt){
			$this->qt = $qt;
		}

		public function getCategory(){
			return $this->category;
		}

		public function setCategory($category){
			$this->category = $category;
		}


	}


	interface ProductDAOInterface{

		public function create(Product $product);
		public function update(Product $product);
		public function returnAll($filter);
		public function returnById($id);
		public function delete($id);

	}


?>