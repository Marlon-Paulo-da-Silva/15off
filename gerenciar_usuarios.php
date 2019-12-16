<?php require "pages/header.php"; ?>

<?php 
$an = new Anuncios();
$us = new Usuarios();
$ca = new Categorias();
$categorias = $ca->getLista();

$total_usuarios = $us->getTotalUsuariosPendentes(1);

$usuarios = $us->getUsuarios();
$pagina_atual = 1;

if(isset($_GET['pagina_atual']) && !empty($_GET['pagina_atual'])){
	$pagina_atual = addslashes($_GET['pagina_atual']);
}

$item_por_pagina = 5;

$total_paginas = ceil($total_usuarios / $item_por_pagina);

?>
<div class="container">
<!-- <div class="col-sm-6"> -->
			<center><h1 style="color: #EE9A00">Usuarios Confirmados</h1></center><br />
			<table class="table table-striped">
				<tbody>
					<?php foreach($usuarios as $usuario): ?>
						<tr>
							<td>
								<?php echo $usuario['nome']; ?>
							</td>
							<td>
								<?php echo $usuario['email']; ?>
							</td>
							<td>
								<?php echo $usuario['telefone']; ?>
							</td>
							<td>
								<?php echo $usuario['cpf']; ?>
							</td>
							<td>
					<a href="excluir-usuario.php?id=<?php echo $usuario['id']; ?>" class="btn btn-danger">deletar</a>
				</td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
			<ul class="pagination">
				<?php $endereco = $_SERVER ['REQUEST_URI']; ?>

				<?php for ($q=0; $q < $total_paginas ; $q++):?>

					<li class="<?php echo ($pagina_atual == ($q+1))?'active':'' ?>">
						<a href="<?php if(strlen($endereco) < 30):?>gerenciar_usuarios.php?pagina_atual=<?php else: echo (strpos($endereco,'pagina_atual') === false)?$endereco.'?pagina_atual=':substr($endereco, 0, -1); endif; echo ($q+1); ?>"><?php echo ($q+1); ?></a></li>

					<?php endfor; ?>
				</ul>
			</div>
<!-- </div> -->
</div>


<?php require "pages/footer.php" ?>