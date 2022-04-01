<?php 


	require_once("templates/header.php");
	require_once("dao/CategoryDAO.php");
	require_once("classes/Upload.php");

	if(!isset($_SESSION['logged'])){
		header('Location: '. $BASE_URL);
		exit;
	}

	

	$msg = null;
	$typeMsg = "error";

	$categoryDAO = new CategoryDAO($pdo);
	$sanitize = new Sanitize();
	$productDAO = new ProductDAO($pdo);
    $newProduct = new Product();

	if(isset($_GET['id'])){

		$id = $sanitize->sanitizeId($_GET['id']);

		$product = $productDAO->returnById($id);
	}

	if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['qt'])  && isset($_POST['category-product'])){
		

		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$qt = $_POST['qt'];
		$category_product = $_POST['category-product'];

		if($name != "" && $description != "" && $price != "" && $qt != ""  && $category_product != ""){


        	$name = $sanitize->sanitizeText($name);
        	$description = $sanitize->sanitizeText($description);
			$category_product = $sanitize->sanitizeText($category_product);
			$price = $sanitize->sanitizeNumber($price);
        	$qt = $sanitize->sanitizeNumber($qt);
        	$nameImage = $resultUpload;


        	$newProduct->setName($name);
        	$newProduct->setDescription($description);
        	$newProduct->setPrice($price);
        	$newProduct->setQt($qt);
        	$newProduct->setImg($nameImage);
        	$newProduct->setCategory($category_product);

        	$productDAO->update($newProduct);

        	$msg = "Produto Atualizo com Sucesso!";
        	$typeMsg = "success";
	        

		}else{
			$msg = "Preencha Todos os Campos!";
		}

		




	}


?>


<div class="container">

	<form action="edit.php" method="POST" class="create" >

		<h1>Cadastrar Produto</h1>


		<label>
			Categoria
			<select name="category-product">
				<?php foreach ($listCategories as $category): ?>

					<?php if($category->getCategory() == $product->getCategory()):?>

							<option selected value="<?=$category->getCategory()?>"><?=$category->getCategory()?></option>
					<?php else:?>

						<option value="<?=$category->getCategory()?>"><?=$category->getCategory()?></option>

					<?php endif?>

					
				<?php endforeach ?>
			</select>
		</label>

		<input type="text" name="name" placeholder="Nome do Produto" value="<?=$product->getName()?>">

		<input type="text" name="description" placeholder="Descrição do Produto"  value="<?=$product->getDescription()?>">

		<div class="qt-price">
			<input type="text" name="price" id="" placeholder="R$ Preço"  value="<?=$product->getPrice()?>">
			<input type="number" name="qt" placeholder="Quantidade"  value="<?=$product->getQt()?>">
		</div>

		<input type="submit" value="Cadastrar Produto">

		<?php if($msg):?>
				<span class="msg <?=$typeMsg?>"><?=$msg?></span>
		<?php endif?>
		
	</form>
</div>

<?php require_once("templates/footer.php")?>