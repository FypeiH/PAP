<?php 

require_once("../../conexao.php");


$id = $_POST['id'];



$resultado = $pdo->prepare("DELETE from remedios where id = :id");

$resultado->bindValue(":id", $id);

$resultado->execute();


?>