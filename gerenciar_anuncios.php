<?php require "pages/header.php"; ?>

<?php 
$an = new Anuncios();
$us = new Usuarios();
$ca = new Categorias();
$categorias = $ca->getLista();



$total_anuncio = $an->getTotalAnunciosPendentes(0);
$total_empresas = $us->getTotalUsuarios();

$pagina_atual = 1;

if(isset($_GET['pagina_atual']) && !empty($_GET['pagina_atual'])){
	$pagina_atual = addslashes($_GET['pagina_atual']);
}

$item_por_pagina = 5;

$total_paginas = ceil($total_anuncio / $item_por_pagina);

$anunciosConfir = $an->getUltimosAnunciosPendentes($pagina_atual, $item_por_pagina, 0);
?>
<div class="container">
<!-- <div class="col-sm-6"> -->
			<center><h1 style="color: #EE9A00">Anuncios Confirmados</h1></center><br />
			<table class="table table-striped">
				<tbody>
					<?php foreach($anunciosConfir as $anuncio): ?>
						<tr>
							<td>
								<?php if(empty($anuncio['url'])): ?>
									<a  href="produto.php?id=<?php echo $anuncio['id']; ?>" style="color: #EE7600"><img src="assets/images/default.png" border="0"  height="100"/></a>
								<?php else: ?>
									<a href="produto.php?id=<?php echo $anuncio['id']; ?>"><img src="assets/images/anuncios/<?php echo $anuncio['url']; ?>" class="foto_redimensionada" border="0" width="100" height="100"/></a>
								<?php endif; ?>
							</td>
							<td>
								<h3><a href="produto.php?id=<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a><br /></h3>
								<?php echo $anuncio['categoria'] ?>
							</td>
							<td>
								<h4><br /><?php echo  $anuncio['nomeDoVendedor'] ?></h4>
								Vendedor
							</td>
							<td>
								<h4><br />R$ <?php echo number_format($anuncio['valor'], 2); ?></h4>
							</td>
							<td>
					<a href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-danger">Deletar</a>
				</td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
			<ul class="pagination">
				<?php $endereco = $_SERVER ['REQUEST_URI']; ?>

				<?php for ($q=0; $q < $total_paginas ; $q++):?>

					<li class="<?php echo ($pagina_atual == ($q+1))?'active':'' ?>">
						<a href="<?php if(strlen($endereco) < 30):?>gerenciar_anuncios.php?pagina_atual=<?php else: echo (strpos($endereco,'pagina_atual') === false)?$endereco.'?pagina_atual=':substr($endereco, 0, -1); endif; echo ($q+1); ?>"><?php echo ($q+1); ?></a></li>

					<?php endfor; ?>
				</ul>
			</div>
<!-- </div> -->
</div>


<?php require "pages/footer.php" ?>