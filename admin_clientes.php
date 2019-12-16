<?php require "pages/header.php" ?>
<?php 
if (empty($_SESSION['cLogin'])){
	?>
	<script type="text/javascript">window.location.href="login.php"</script>
<?php
	exit();
	}
 ?>

<div class="container">
	<h1>Controle de Clientes</h1>

	<table class="table table-stripped">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Nome</th>
				<th>Email</th>
				<th>telefone</th>
				<th>Decisao</th>
			</tr>
		</thead>
			
			<tr>
				<td><img src=""></td>
				<td></td>
				<td></td>
				<td></td>
				<td>
					<a href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-primary">Confirmar</a>
					<a href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-danger">Recusar</a>
				</td>
			</tr>
	</table>
</div>

<?php require "pages/footer.php" ?>
