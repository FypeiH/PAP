<?php 

require_once("../../conexao.php");

$id = $_POST['id'];


$resultado = $pdo->prepare("UPDATE utilizadores set estado_conta = :estado_conta where id = :id");

$resultado->bindValue(":estado_conta", 'Inativo');
$resultado->bindValue(":id", $id);

$resultado->execute();

?>