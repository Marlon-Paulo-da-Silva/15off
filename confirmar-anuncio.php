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

$id = $_GET['id'];

$an->confirmarAnuncio($id);

header("Location: gerenciar_anuncios_pendentes.php");
?>