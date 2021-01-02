<?php 

require_once("../../conexao.php");
@session_start();


$cargo = $_POST['cargo'];
$funcionario = $_POST['funcionario'];
$valor = $_POST['valor'];


$email_utilizador = $_SESSION['email_utilizador'];

//Buscar o nif do utilizador logado

$resultado_ex = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and email = '$email_utilizador'");
$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
$func = $dados_ex[0]['id'];


if($funcionario == '')
{
	echo "Escolha um Funcionário!";
	exit();
}
if($valor == '')
{
	echo "Preencha o Campo!";
	exit();
}



	$resultado = $pdo->prepare("INSERT into pagamentos (funcionario, valor, tesoureiro, data) values (:funcionario, :valor, :tesoureiro, CurDate())");

	$resultado->bindValue(":funcionario", $funcionario);
	$resultado->bindValue(":valor", $valor);
	$resultado->bindValue(":tesoureiro", $func);
	
	$resultado->execute();



//Lançar para a tabela de Movimentações

//Buscar o ultimo id que foi inserido na tabela conta a pagar

$resultado_valor = $pdo->query("SELECT * from pagamentos order by id desc limit 1");
$dados_valor = $resultado_valor->fetchAll(PDO::FETCH_ASSOC);
$id_pgto = $dados_valor[0]['id'];

$resultado = $pdo->prepare("INSERT into movimentacoes (tipo, movimento, valor, tesoureiro, data, id_receber, id_pagar, id_pagamentos) values (:tipo, :movimento, :valor, :tesoureiro, curDate(), :id_receber, :id_pagar, :id_pagamentos)");

$resultado->bindValue(":tipo", 'Saída');
$resultado->bindValue(":movimento", 'Salário dos Funcionários');
$resultado->bindValue(":valor", $valor);
$resultado->bindValue(":tesoureiro", $func);
$resultado->bindValue(":id_receber", NULL);
$resultado->bindValue(":id_pagar", NULL);
$resultado->bindValue(":id_pagamentos", $id_pgto);

$resultado->execute();





	echo "Registado com Sucesso!";


?>