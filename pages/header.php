<?php require "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>15off</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/estilo.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/script.js"></script>
</head>
<body>
	<?php 
	require "./classes/anuncios.class.php";
	require './classes/usuarios.class.php';
	require './classes/categorias.class.php';

	$an = new Anuncios();
	$total_anuncios_pendentes = $an->getTotalAnunciosPendentes(1); ?>

	<body style="background-color: #E8E8E8">
	
	
	<nav class="navbar navbar-default" style="background-color: white" >
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="./"><img align="left" src="15offblack.png" height="50" width="100"></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php 
				if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])):
					?>
				<?php if ($_SESSION['nivel'] == 3) {
					?>
				<li class="nome-user"><a href="./"><i class="fas fa-user-alt"></i>   <?php echo $_SESSION['usuLogado']; ?></a></li>
				<!-- <li><a href="gerenciar_clientes.php">Gerenciar Clientes</a></li>
				<li><a href="gerenciar_clientes_pendentes.php">Gerenciar Clientes Pendentes</a></li> -->
				
				<li><a href="meus-anuncios.php" style="color: #EE9A00"><i class="fas fa-bullhorn" style="color: #EE9A00"></i>   MEUS ANUNCIOS</a></li>
				<li><a href="sair.php"><i class="fas fa-door-open"></i>   SAIR</a></li>
					<?php
				}elseif (empty($_SESSION['nivel']) == 1) {
					?>
					<li><a href="./"><i class="fas fa-user-alt"></i>   <?php echo $_SESSION['usuLogado']; ?></a></li>
					<li><a href="meus-anuncios.php"><i class="fas fa-bullhorn"></i>   MEUS ANUNCIOS</a></li>
					
					<li><a href="sair.php"><i class="fas fa-door-open">   SAIR</a></li>
					<?php
				}else {
					?>
					<li><a href="./"><i class="fas fa-user-alt"></i>   <?php echo $_SESSION['usuLogado']; ?></a></li>
					<li><a href="meus-anuncios.php" style="color: #EE9A00"><i class="fas fa-bullhorn" style="color: #EE9A00"></i>   MEUS ANUNCIOS</a></li>
					<li><a href="sair.php"><i class="fas fa-door-open"></i>   SAIR</a></li>
					<?php
				} ?>


			<?php else: ?>
				<li><a href="login.php"><i class="fas fa-user-alt"></i>   LOGIN</a></li>
				<li><a href="cadastro_usuario.php" style="color: #EE9A00"><i class="fas fa-user-plus" style="color: #EE9A00"></i>   CADASTRE-SE</a></li>

			<?php endif; ?>

		</ul>
	</div>

</nav>