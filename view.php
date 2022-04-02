<?php

	require_once("templates/header.php");



	$productDAO = new ProductDAO($pdo);
    $newProduct = new Product();
    $sanitize = new Sanitize();

	if(isset($_POST['id']) && isset($_POST['qt'])){

		$id = $sanitize->sanitizeId($_POST['id']);
		$qt = $sanitize->sanitizeId($_POST['qt']);
		$current_qt = $_SESSION['qt_product'];

		if($current_qt == 0){
			$_SESSION['buy'] = "O Produto Está em Falta";
		}else{
			$productDAO->buy($id, $qt, $current_qt);
			$_SESSION['buy'] = "Compra Efetuada com Sucesso";	
		}

		header("Location: $BASE_URL" . "view.php?id=$id");
		exit;



	}

	if(isset($_GET['id'])){

		if(isset($_SESSION['buy'])){
			$msg = $_SESSION['buy'];

			unset($_SESSION['buy']);
		}
		$id = $sanitize->sanitizeId($_GET['id']);

		$product = $productDAO->returnById($id);

		$_SESSION['qt_product'] = $product->getQt();

	}else{
		header("Location: $BASE_URL");
		exit;

	}

?>


<div class="container">
	
	<?php if(isset($msg)):?>
		<div class="msg success">
			<?=$msg?>
		</div>
	<?php endif?>

	<div class="view-product">
		
		<div class="image-product">
			<img src="<?=$BASE_URL?>images/<?=$product->getImg()?>" alt="">
		</div>

		<div class="info-product">
			<div class="name-product">
				<span><?=$product->getName() ?></span>
			</div>

			<div class="desc-product">
				<span><?=$product->getDescription() ?></span>
			</div>

			<div class="price-qt">
				<span> R$ <?=number_format($product->getPrice(),2) ?></span>
				<span >
					<?=$product->getQt()?> Unidades
				</span> 

				
			</div>

			<form action="<?=$BASE_URL?>view.php" method="POST" class="buy">
				
				<input type="hidden" name="id" value="<?=$product->getId()?>">

				<label class="product-unidades">
					<span>Unidades</span>
					<input type="number" name="qt" placeholder="Unidades" value="1" min="1">
				</label>

				<input type="submit" value="Efetuar Compra">
			</form>
		</div>


	</div>
</div>

<?php require_once("templates/footer.php");?>