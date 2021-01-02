<?php 

require_once("../../conexao.php");


$id = $_POST['id'];

//Buscar a quantidade de entrada excluida

$resultado_ent = $pdo->query("SELECT * from saidas_remedios where id = '$id'");
$dados_ent = $resultado_ent->fetchAll(PDO::FETCH_ASSOC);
$quant_ent = $dados_ent[0]['quantidade'];
$id_rem = $dados_ent[0]['remedio'];

//Buscar o estoque do remedio

$resultado_rem = $pdo->query("SELECT * from remedios where id = '$id_rem'");
$dados_rem = $resultado_rem->fetchAll(PDO::FETCH_ASSOC);
$quant_remedio = $dados_rem[0]['estoque'];


$quantidade_total = $quant_remedio + $quant_ent ;


$resultado = $pdo->query("UPDATE remedios set estoque = '$quantidade_total' where id = '$id_rem'"); 


$resultado = $pdo->prepare("DELETE from saidas_remedios where id = :id");

$resultado->bindValue(":id", $id);

$resultado->execute();


?>