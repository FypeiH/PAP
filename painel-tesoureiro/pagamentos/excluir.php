<?php 

require_once("../../conexao.php");


$id = $_POST['id'];


$resultado = $pdo->prepare("DELETE from pagamentos where id = :id");

$resultado->bindValue(":id", $id);

$resultado->execute();


$resultado = $pdo->prepare("DELETE from movimentacoes where id_pagamentos = :id");

$resultado->bindValue(":id", $id);

$resultado->execute();


?>