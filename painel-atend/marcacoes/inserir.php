<?php 

require_once("../../conexao.php");


$data = $_POST['data'];
$hora = $_POST['hora'];
$paciente = $_POST['txtid'];
$tipo_atendimento = $_POST['atendimentos'];
$medico = $_POST['medico'];


$res_valor = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_valor);


if($linhas > 0)
{
	
	$valor = $dados_valor[0]['valor']; 

}





$resultado = $pdo->prepare("INSERT into consultas (data, hora, paciente, tipo_atendimento, medico, valor, estado_pagamento) values (:data, :hora, :paciente, :tipo_atendimento, :medico, :valor, :estado_pagamento)");

$resultado->bindValue(":data", $data);
$resultado->bindValue(":hora", $hora);
$resultado->bindValue(":paciente", $paciente);
$resultado->bindValue(":tipo_atendimento", $tipo_atendimento);
$resultado->bindValue(":medico", $medico);
$resultado->bindValue(":valor", $valor);
$resultado->bindValue(":estado_pagamento", 'Não');

$resultado->execute();


//Trazer o último id da consulta inserida

$resultado_id = $pdo->query("SELECT * from consultas order by id desc LIMIT 1");
$dados_id = $resultado_id->fetchAll(PDO::FETCH_ASSOC);
$id_consulta = $dados_id[0]['id'];



//Inserir dados na tabela de contas a receber

$resultado_c = $pdo->prepare("INSERT into contas_receber (descricao, valor, vencimento, id_consulta) values (:descricao, :valor, :vencimento, :id_consulta)");

$resultado_c->bindValue(":descricao", $tipo_atendimento);
$resultado_c->bindValue(":valor", $valor);
$resultado_c->bindValue(":vencimento", $data);
$resultado_c->bindValue(":id_consulta", $id_consulta);

$resultado_c->execute();



echo "Registado com Sucesso!";


?>