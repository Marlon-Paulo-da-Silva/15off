<?php 
require 'config.php';


require 'classes/usuarios.class.php';

if(empty($_SESSION['cLogin']))
{
	header("Location: login.php");
	exit();
}



$usu = new Usuarios();

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
	$usu->deleteUsuario($id);
}

header("Location: gerenciar_usuarios_pendentes.php");

