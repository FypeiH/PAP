<?php 

require_once("../../conexao.php");


$id = $_POST['id'];

$resultado = $pdo->prepare("DELETE from consultas where id = :id");

$resultado->bindValue(":id", $id);

$resultado->execute();

$resultado_c = $pdo->prepare("DELETE from contas_receber where id_consulta = :id");

$resultado_c->bindValue(":id", $id);

$resultado_c->execute();


?>