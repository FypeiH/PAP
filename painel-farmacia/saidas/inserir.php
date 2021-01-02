<?php 

require_once("../../conexao.php");


$remedio = $_POST['remedio'];
$quantidade = $_POST['quantidade'];
$farmaceutico = $_POST['farmaceutico'];

//Buscar o nome do remedio

$resultado_nome = $pdo->query("SELECT * from remedios where id = '$remedio'");
$dados_nome = $resultado_nome->fetchAll(PDO::FETCH_ASSOC);
$nome_remedio = $dados_nome[0]['nome'];


if($remedio == '')
{
	echo "Selecione um Remédio!";
	exit();
}


$resultado = $pdo->prepare("INSERT into saidas_remedios (remedio, quantidade, farmaceutico, data) values (:remedio, :quantidade, :farmaceutico, curDate())");

$resultado->bindValue(":remedio", $remedio);
$resultado->bindValue(":quantidade", $quantidade);
$resultado->bindValue(":farmaceutico", $farmaceutico);

$resultado->execute();


	//Trazer o total de estoque do remédio inserido para poder adicionar a quantidade comprada


//Buscar o estoque do remedio

$resultado_rem = $pdo->query("SELECT * from remedios where id = '$remedio'");
$dados_rem = $resultado_rem->fetchAll(PDO::FETCH_ASSOC);
$quant_remedio = $dados_rem[0]['estoque'];


$quantidade_total = $quant_remedio - $quantidade;


$resultado = $pdo->query("UPDATE remedios set estoque = '$quantidade_total' where id = '$remedio'"); 





echo "Registado com Sucesso!";


?>