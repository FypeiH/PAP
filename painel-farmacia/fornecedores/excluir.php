<?php 

require_once("../../conexao.php");


$id = $_POST['id'];



$resultado = $pdo->prepare("DELETE from fornecedores where id = :id");

$resultado->bindValue(":id", $id);

$resultado->execute();


?>