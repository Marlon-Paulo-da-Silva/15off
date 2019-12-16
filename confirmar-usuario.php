<?php require 'pages/header.php'; ?>
<?php 
if(empty($_SESSION['cLogin']))
{
	?>
	<script type="text/javascript">window.location.href="login.php";</script>
	<?php
	exit();
}



$us = new Usuarios();

$id = $_GET['id'];

$us->confirmarUsuario($id);

header("Location: gerenciar_usuarios_pendentes.php");
?>