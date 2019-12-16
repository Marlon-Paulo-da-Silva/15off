<?php require "pages/header.php" ?>
<?php 
if(empty($_SESSION['cLogin'])){
	?>
	<script type="text/javascript">window.location.href="login.php"</script>
	<?php
	exit();
}

?>
<div class="container">
	<h1>Meus Anuncios</h1>

	<p><a href="add-meus_anuncios.php" class="btn btn-default">Adicionar Anuncios</a></p>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Titulo</th>
				<th>Valor</th>
				<th>Estado</th>
				
			</tr>
		</thead>
		
		<?php 
		$anu = new Anuncios();
		$anuncios = $anu->getMeusAnuncios();

		foreach ($anuncios as $anuncio):
			?>

		<tr>
			<?php if(empty($anuncio['url'])): ?>
				<td><a href="produto.php?id=<?php echo $anuncio['id']; ?>"><img src="assets/images/default.png" border="0"  height="50"/></a></td>
			<?php else: ?>
				<td><a href="produto.php?id=<?php echo $anuncio['id']; ?>"><img src="assets/images/anuncios/<?php echo $anuncio['url']; ?>" class="foto_redimensionada" border="0" width="100" height="100"/></a>
				</td>
			<?php endif; ?>
			<td><a href="produto.php?id=<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a><br /><br />
				<a href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-primary">Editar</a><br /><br />
				<a href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-danger">Excluir</a>
			</td>
			<td>R$ <?php echo number_format($anuncio['valor'], 2); ?></td>
			<td>

				<?php switch ($anuncio['estado']) {
					case '4':
					echo "Ruim";
					break;
					case '1':
					echo "Bom";
					break;
					case '2':
					echo "Ótimo";
					break;
					default:
					echo "Nunca usado";
					break;
				} ?>
			</td>
		
		</tr>

		<?php
		endforeach;
		?>


	</table>
</div>

<?php require "pages/footer.php" ?>