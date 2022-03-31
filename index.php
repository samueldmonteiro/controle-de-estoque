<?php
	

	require_once("templates/header.php")



?>

	<div class="container">

		<div class="search-product">
			<form method="POST" action="<?=$BASE_URL?>index.php">
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
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			</thead>

			<tbody>
				<tr class="product">
					<td class="id-product">1</td>

					<td class="image-product">
						<img src="image.png">
					</td>

					<td>
						<a class="title-product" href="view.php?id">Refrigerante</a>
					</td>

					<td class="category-product">
						Frios
					</td>

					<td class="edit-product">
						<a href="edit.php?id="><i class="bi bi-pencil"></i></a>
					</td>
					<td class="delete-product">
						<a href="delete.php?id="><i class="bi bi-trash"></i></a>
					</td>

				</tr>

				
			</tbody>
		</table>
	</div>


<?php require_once("templates/footer.php")?>