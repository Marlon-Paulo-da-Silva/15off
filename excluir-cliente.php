<?php 
require 'config.php';

require 'classes/usuarios.class.php';
if(empty($_SESSION['cLogin']))
{
	header("Location: login.php");
	exit();
}



$anu = new Usuarios();

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
	$anu->deleteAnuncio($id);
}

header("Location: meus-anuncios.php");