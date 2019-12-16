<?php require 'pages/header.php'; ?>
<?php 
if(empty($_SESSION['cLogin']))
{
	?>
	<script type="text/javascript">window.location.href="login.php";</script>
	<?php
	exit();
}


$an = new Anuncios();

if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
	$titulo = addslashes($_POST['titulo']);
	$categoria = addslashes($_POST['categoria']);
	$valor = addslashes($_POST['valor']);
	$descricao = addslashes($_POST['descricao']);
	$estado = addslashes($_POST['estado']);
	if(isset($_FILES['fotos'])){
		$fotos = $_FILES['fotos'];
	}else{
		$fotos = array();
	}


	$an->editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);

	?>
	<div class="alert alert-success container">
		<strong>Editado com sucesso <p><h3>  Boas vendas!!!   <br/></h3><a href="meus-anuncios.php" class="alert-link">Clique aqui para voltar aos seus Anuncios</a></p></strong>
	</div>
	<?php
}

if (isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];

	$infoAnun = $an->getAnuncio($id);


} else{
	?>
	<script type=text/javascript>window.location.href="meus-anuncios.php"</script>
	<?php
	exit;
}
?>

<div class="container">
	<h1>Editar Anúncio - <?php echo $infoAnun['titulo']; ?></h1>

	<form action="" method="Post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="categoria">Categoria:</label>
			<select name="categoria" id="categoria" class="form-control">
				<?php

				$cat = new Categorias();
				$categorias = $cat->getLista();

				foreach ($categorias as $categoria):
					?>
				<option value="<?php echo $categoria['id'] ?>" <?php echo ($infoAnun['id_categoria'] == $categoria['id'])?'selected="selected"':""; ?>><?php echo $categoria['nome'] ?></option>
				<?php
				endforeach;
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="titulo">Titulo:</label>
			<input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $infoAnun['titulo']; ?>"/>
		</div>
		<div class="form-group">
			<label for="valor">Valor:</label>
			<input type="text" name="valor" id="valor" class="form-control" value=<?php echo $infoAnun['valor']; ?>>
		</div>
		<div class="form-group">
			<label for="descricao">Descrição:</label>
			<textarea type="text" name="descricao" id="descricao" class="form-control" ><?php echo $infoAnun['descricao']; ?></textarea>
		</div>
		<div class="form-group">
			<label for="estado">Estado de Conservação:</label>
			<select name="estado" id="estado" class="form-control" >
				<option value="4" <?php echo ($infoAnun['estado'] == '4')?'selected="selected"':""; ?> >Ruim</option>
				<option value="1" <?php echo ($infoAnun['estado'] == '1')?'selected="selected"':""; ?> >Bom</option>
				<option value="2" <?php echo ($infoAnun['estado'] == '2')?'selected="selected"':""; ?> >Otimo</option>
				<option value="3" <?php echo ($infoAnun['estado'] == '3')?'selected="selected"':""; ?> >Nunca usado</option>
			</select>
		</div>
		<div class="form-group">
			<label for="add-fotos">Fotos do anuncio:</label>
			<input type="file" name="fotos[]" multiple /><br/>

			<div class="panel panel-default">
				<div class="panel-heading">Fotos:</div>
				<div class="panel-body">
					<?php foreach ($infoAnun['fotos'] as $info):?>
						<div class="foto_item">
							<img src="assets/images/anuncios/<?php echo $info['url'];  ?>" class="img-thumbnail" border="0"/><br/>
							<a href="excluir-foto.php?id=<?php echo $info['id']; ?>" class="btn btn-default">Excluir foto</a>

						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<button class="btn btn-default" type="submit">Salvar</button>
	</form>
</div>

<?php require 'pages/footer.php'; ?>