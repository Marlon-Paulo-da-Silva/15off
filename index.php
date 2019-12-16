<?php require "pages/header.php"; ?>

<?php 
$an = new Anuncios();
$us = new Usuarios();
$ca = new Categorias();
$categorias = $ca->getLista();


$filtros = array(
	'categoria'=>'',
	'estado'=>'',
	'preco'=>''
	);
if(isset($_GET['filtros']) && !empty($_GET['filtros'])){
	$filtros = $_GET['filtros'];
}

$total_anuncio = $an->getTotalAnuncios($filtros);
$total_empresas = $us->getTotalUsuarios();

$pagina_atual = 1;

if(isset($_GET['pagina_atual']) && !empty($_GET['pagina_atual'])){
	$pagina_atual = addslashes($_GET['pagina_atual']);
}

$item_por_pagina = 5;

$total_paginas = ceil($total_anuncio / $item_por_pagina);

$anuncios = $an->getUltimosAnunciosComFiltro($pagina_atual, $item_por_pagina, $filtros);

$total_usuarios_pendentes = $us->getTotalUsuariosPendentes(1);
$total_anuncios_pendentes = $an->getTotalAnunciosPendentes(1);
?>



<div class="container-fluid">
	<div class="row">
			<?php 
					if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin']) && $_SESSION['nivel'] == 3):
						?>
			<div class="col-sm-3 col-md-2 sidebar">
				<h4  style="color: #EE9A00">Gerenciar Anuncios</h4>
			
						<div class="row">
			
						<ul class="nav navbar-sidebar" style="background-color: white">
							<li>
								<a href="gerenciar_anuncios.php">Anuncios Aprovados</a>
							</li>
							<li>
								<a href="gerenciar_anuncios_pendentes.php">Anuncios Pendentes <span class="badge">  <?php echo $total_anuncios_pendentes; ?></span>
								</a>
							</li>
							<li>
								<a href="meus-anuncios.php">Meus Anuncios</a>
							</li>
						</ul>
						</div>
				<br />
				<br />
				<h4  style="color: #EE9A00">Gerenciar Usuarios</h4>
			
						<div class="row">
			
						<ul class="nav navbar-sidebar" style="background-color: white">
							<li>
								<a href="gerenciar_usuarios.php">Usuarios Aprovados</a>
							</li>
							<li>
								<a href="gerenciar_usuarios_pendentes.php">Usuarios Pendentes <span class="badge">  <?php echo $total_usuarios_pendentes; ?></span>
								</a>
							</li>
						</ul>
						</div>
			</div>
			<?php endif; ?>
	<div class="<?php echo (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin']) && $_SESSION['nivel'] == 3)?'col-sm-9':'col-sm-12' ?>" >	
		<div class="jumbotron" style="background-color: white">
			<h2>Nós temos para hoje <?php echo $total_anuncio; ?> offertas</h2>
			<p>Mais de <?php echo $total_empresas; ?> empresas cadastradas</p><br />
		</div>
			
			<div class="col-sm-2">
				<h4 style="color: #EE9A00">Pesquisa Avançada</h4>
				<form method="GET">
					<div class="form-group">
						<label for="categoria">Categoria:</label>
						<select name="filtros[categoria]" id="categoria" class="form-control">
							<option></option>
							<?php foreach ($categorias as $cate):?>
								<option value="<?php echo $cate['id'] ?>" <?php echo ($cate['id'] == $filtros['categoria'])?'selected="selected"':''?> ><?php echo $cate['nome'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="preco">Preço:</label>
						<select name="filtros[preco]" id="preco" class="form-control">
							<option></option>
							<option value="0-50" <?php echo ($filtros['preco'] == "0-50")?'selected="selected"':''?> >R$ 0 - 50</option>
							<option value="51-100" <?php echo ($filtros['preco'] == "51-100")?'selected="selected"':''?>>R$ 51 - 100</option>
							<option value="101-200" <?php echo ($filtros['preco'] == "101-200")?'selected="selected"':''?>>R$ 101 - 200</option>
							<option value="201-600"<?php echo ($filtros['preco'] == "201-600")?'selected="selected"':''?>>R$ 201 - 600</option>
							<option value="601-1000000" <?php echo ($filtros['preco'] == "601-1000000")?'selected="selected"':''?>>mais de R$ 600</option>
						</select>
					</div>
					<div class="form-group">
						<label for="estado">Estado de Conservação:</label>
						<select name="filtros[estado]" id="estado" class="form-control">
							<option></option>
							<option value="4" <?php echo ($filtros['estado'] == "4")?'selected="selected"':''?>>Ruim</option>
							<option value="1" <?php echo ($filtros['estado'] == "1")?'selected="selected"':''?>>Bom</option>
							<option value="2" <?php echo ($filtros['estado'] == "2")?'selected="selected"':''?>>Otimo</option>
							<option value="3" <?php echo ($filtros['estado'] == "3")?'selected="selected"':''?>>Nunca usado</option>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn " style="background-color: white">Pesquisar</button>
					</div>
				</form>
			</div>

			<div class="col-sm-10">
				<h4 style="color: #EE9A00">Últimos Anúncios</h4>
				<table class="table table-striped">
					<tbody>
						<?php foreach($anuncios as $anuncio): ?>
							<tr>
								<td>
									<?php if(empty($anuncio['url'])): ?>
										<a  href="produto.php?id=<?php echo $anuncio['id']; ?>"><img src="assets/images/default.png" border="0"  height="100"/></a>
									<?php else: ?>
										<a href="produto.php?id=<?php echo $anuncio['id']; ?>"><img src="assets/images/anuncios/<?php echo $anuncio['url']; ?>" class="foto_redimensionada" border="0" width="100" height="100"/></a>
									<?php endif; ?>
								</td>
								<td>
									<h3><a href="produto.php?id=<?php echo $anuncio['id']; ?>" style="color: inherit;"><?php echo $anuncio['titulo']; ?></a><br /></h3>
									<?php echo $anuncio['categoria'] ?>
								</td>
								<td>
									<h4><br /><?php echo  $anuncio['nomeDoVendedor'] ?></h4>
									Vendedor
								</td>
								<td>
									<h4><br />R$ <?php echo number_format($anuncio['valor'], 2); ?></h4>
								</td>
							</tr>

						<?php endforeach; ?>
					</tbody>
				</table>
				<ul class="pagination">
					<?php $endereco = $_SERVER ['REQUEST_URI']; ?>


					<?php for ($q=0; $q < $total_paginas ; $q++):?>

						<li class="<?php echo ($pagina_atual == ($q+1))?'active':'' ?>">
							<a href="<?php if(strlen($endereco) < 30):?>index.php?pagina_atual=<?php else: echo (strpos($endereco,'pagina_atual') === false)?$endereco.'&pagina_atual=':substr($endereco, 0, -1); endif; echo ($q+1); ?>">

								<?php echo ($q+1); ?>
								
							</a></li>

					<?php endfor; ?>
				</ul>
			</div>
		</div>
	</div>
	</div>
</div>

	<?php require "pages/footer.php"; ?>
