<?php
	

	require_once("templates/header.php");

	
	$filter = null;
	$productDAO = new ProductDAO($pdo);


	if(isset($_GET['search'])){

		$sanitize = new Sanitize();
		$filter = $sanitize->sanitizeTexT($_GET['search']);

	}

	$listProducts = $productDAO->returnAll($filter, $_COOKIE['category']);

?>

<div class="container">

	<div class="search-product">
		<form method="GET" action="<?=$BASE_URL?>index.php">
			<input type="text" name="search" placeholder="Busque por Produtos">
			<button><i class="bi bi-search"></i></button>
		</form>
	</div>
	
	<table class="container-products">

		<thead>
			<tr>
				<th>Id</th>
				<th>Imagem</th>
				<th>Nome do Produto</th>
				<th>Categoria</th>
				<th>Preço</th>
				<th>Quantidade</th>
				<th>Editar</th>
				<th>Excluir</th>

			</tr>
		</thead>

		<tbody>

			<?php foreach ($listProducts as $product): ?>
				
				<tr class="product">

					<td class="id-product"><?=$product->getId()?></td>

					<td class="image-product">
						<img src="<?=$BASE_URL?>images/<?=$product->getImg()?>">
					</td>

					<td>
						<a class="title-product" href="<?=$BASE_URL?>view.php?id=<?=$product->getId()?>"><?=$product->getName()?></a>
					</td>

					<td class="category-product">
						<?=$product->getCategory()?>
					</td>

					<td>
						<?="R$ " . number_format($product->getPrice(),2)?>
					</td>

					<td>
						<?=$product->getQt()?>
					</td>

					<?php if(isset($_SESSION['logged'])):?>

						<td class="edit-product">
							<a href="edit.php?id=<?=$product->getId()?>"><i class="bi bi-pencil"></i></a>
						</td>

						<td class="delete-product">
							<a href="delete.php?id=<?=$product->getId()?>"><i class="bi bi-trash"></i></a>
						</td>
					<?php else:?>
							<td class="edit-product disable">
								<i class="bi bi-pencil"></i>
							</td>

							<td class="delete-product disable">
								<i class="bi bi-trash"></i>
							</td>
					<?php endif?>

				</tr>

			<?php endforeach ?>
		
		</tbody>
	</table>
</div>


<?php require_once("templates/footer.php")?>