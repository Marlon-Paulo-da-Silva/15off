<?php 
require 'config.php';

require 'classes/anuncios.class.php';

if(empty($_SESSION['cLogin']))
{
	header("Location: login.php");
	exit();
}



$anu = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
	$anu->deleteAnuncio($id);
}

header("Location: gerenciar_anuncios_pendentes.php");

