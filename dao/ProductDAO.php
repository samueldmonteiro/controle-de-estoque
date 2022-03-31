<?php

	require_once("models/Product.php");


	class ProductDAO implements ProductDAOInterface{

		public function create(Product $product){

		}
		
		public function update(Product $product){}
		public function returnAll($filter){}
		public function returnById($id){}
		public function delete($id){}

	}


?>