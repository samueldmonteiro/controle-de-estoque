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

	$listCategories = $categoryDAO->returnAll();

	if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['qt']) && isset($_FILES['image']) && isset($_POST['category-product'])){
		

		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$qt = $_POST['qt'];
		$image = $_FILES['image'];
		$category_product = $_POST['category-product'];

		if($name != "" && $description != "" && $price != "" && $qt != "" && $image['name'] != "" && $category_product != ""){

			// Dados Imagem

	        $fileName = $image['name'];
	        $fileType = $image['type'];
	        $fileSize = $image['size'];
	        $fileTmp =  $image['tmp_name'];
	        
	        $upload = new Upload($fileName, $fileType, $fileSize, $fileTmp);

	        $resultUpload = $upload->resultUpload;

	        if(!$resultUpload){
	        	$msg = $upload->getAlerts()[0];
	        }else{

	        	$sanitize = new Sanitize();

	        	$name = $sanitize->sanitizeText($name);
	        	$description = $sanitize->sanitizeText($description);
				$category_product = $sanitize->sanitizeText($category_product);
				$price = $sanitize->sanitizeNumber($price);
	        	$qt = $sanitize->sanitizeNumber($qt);
	        	$nameImage = $resultUpload;

	        	$productDAO = new ProductDAO($pdo);

	        	$newProduct = new Product();

	        	$newProduct->setName($name);
	        	$newProduct->setDescription($description);
	        	$newProduct->setPrice($price);
	        	$newProduct->setQt($qt);
	        	$newProduct->setImg($nameImage);
	        	$newProduct->setCategory($category_product);

	        	$productDAO->create($newProduct);

	        	$msg = "Produto cadastrado com Sucesso!";
	        	$typeMsg = "success";
	        }

		}else{
			$msg = "Preencha Todos os Campos!";
		}

		




	}


?>


<div class="container">

	<form action="create.php" method="POST" class="create" enctype="multipart/form-data">

		<h1>Cadastrar Produto</h1>

		<label for="image" class="label-image">
			Imagem do Produto
			<input type="file" name="image" id="image">
		</label>

		<label>
			Categoria
			<select name="category-product">
				<?php foreach ($listCategories as $category): ?>
					<option value="<?=$category->getCategory()?>"><?=$category->getCategory()?></option>
				<?php endforeach ?>
			</select>
		</label>

		<input type="text" name="name" placeholder="Nome do Produto">

		<input type="text" name="description" placeholder="Descrição do Produto">

		<div class="qt-price">
			<input type="text" name="price" id="" placeholder="R$ Preço">
			<input type="number" name="qt" placeholder="Quantidade">
		</div>

		<input type="submit" value="Cadastrar Produto">

		<?php if($msg):?>
				<span class="msg <?=$typeMsg?>"><?=$msg?></span>
		<?php endif?>
		
	</form>
</div>

<?php require_once("templates/footer.php")?>