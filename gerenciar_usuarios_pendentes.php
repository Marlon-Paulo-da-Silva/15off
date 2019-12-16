
<?php require "pages/header.php"; ?>

<?php 
$an = new Anuncios();
$us = new Usuarios();
$ca = new Categorias();
$categorias = $ca->getLista();



$total_usuarios = $us->getTotalUsuariosPendentes(1);
$total_empresas = $us->getTotalUsuarios();
$usuarios = $us->getUsuarios();

$pagina_atual = 1;

if(isset($_GET['pagina_atual']) && !empty($_GET['pagina_atual'])){
	$pagina_atual = addslashes($_GET['pagina_atual']);
}

$item_por_pagina = 5;

$total_paginas = ceil($total_usuarios / $item_por_pagina);

$usuariosPend = $us->getUltimosUsuariosPendentes($pagina_atual, $item_por_pagina, 1);

// $anuncios = $an->getUltimosAnunciosPedentes($pagina_atual, $item_por_pagina, 0);

?>
<div class="container">
			<center><h1 style="color: #EE9A00">Usuarios Pendentes</h1></center><br />
			<table class="table table-striped">
				<tbody>
					<?php foreach($usuariosPend as $usuarioP): ?>
						<tr>
							<td>
								<?php echo $usuarioP['nome']; ?>
							</td>
							<td>
								<?php echo $usuarioP['email']; ?>
							</td>
							<td>
								<?php echo $usuarioP['telefone']; ?>
							</td>
							<td>
								<?php echo $usuarioP['cpf']; ?>
							</td>
							<td>
					<a href="confirmar-usuario.php?id=<?php echo $usuarioP['id']; ?>" class="btn btn-primary">Confirmar</a>
					<a href="recusar-usuario.php?id=<?php echo $usuarioP['id']; ?>" class="btn btn-danger">Recusar</a>
				</td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
			<ul class="pagination">
				<?php $endereco = $_SERVER ['REQUEST_URI']; ?>

				<?php for ($q=0; $q < $total_paginas ; $q++):?>

					<li class="<?php echo ($pagina_atual == ($q+1))?'active':'' ?>">
						<a href="<?php if(strlen($endereco) < 30):?>gerenciar_usuarios_pendentes.php?pagina_atual=<?php else: echo (strpos($endereco,'pagina_atual') === false)?$endereco.'?pagina_atual=':substr($endereco, 0, -1); endif; echo ($q+1); ?>"><?php echo ($q+1); ?></a></li>

					<?php endfor; ?>
				</ul>
			</div>
</div>


<?php require "pages/footer.php" ?>