<?php 
require 'config.php';


if(empty($_SESSION['cLogin']))
{
	header("Location: login.php");
	exit();
}



$anu = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
	$id_anuncio = $anu->excluiFoto($id);
}

if(isset($id_anuncio)){
	header("Location: editar-anuncio.php?id=".$id_anuncio);
}else{
	header("Location: meus-anuncios.php");
}

