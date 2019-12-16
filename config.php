<?php
session_start();
global $pdo;
try{
	$pdo = new PDO("mysql:dbname=15off;host=localhost","root","");
	// $pdo = new PDO("mysql:dbname=u862903654_15tst;host=mysql.hostinger.com.br","u862903654_marlo","996885521");
}catch(PDOException $e){
	echo "Houve Erro: ".$e->getMessage();
	exit;
}
