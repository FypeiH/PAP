<?php 

require_once("../../conexao.php");
@session_start();

$forma = $_POST['forma'];
$tipo = $_POST['tipo'];


$id = $_POST['id'];
$id_consulta = $_POST['id_consulta'];

$email_utilizador = $_SESSION['email_utilizador'];


//Buscar o nif do utilizador logado

$resultado_ex = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and email = '$email_utilizador'");
$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
$func = $dados_ex[0]['id'];
 

$resultado = $pdo->prepare("UPDATE contas_receber set data_baixa = curDate(), forma_pagamento = :forma, tipo_pagamento = :tipo, tesoureiro = :tesoureiro where id = :id");

$resultado->bindValue(":forma", $forma);
$resultado->bindValue(":tipo", $tipo);
$resultado->bindValue(":tesoureiro", $func);
$resultado->bindValue(":id", $id);

$resultado->execute();


$resultado = $pdo->query("UPDATE consultas set estado_pagamento = 'Sim' where id = '$id_consulta'");




//Lançar para a tabela de Movimentações


//Buscar o valor da consulta feita

$resultado_valor = $pdo->query("SELECT * from contas_receber where id = '$id'");
$dados_valor = $resultado_valor->fetchAll(PDO::FETCH_ASSOC);
$valor = $dados_valor[0]['valor'];

//Buscar o nome do movimento

$resultado_desc = $pdo->query("SELECT * from contas_receber where id = '$id'");
$dados_desc = $resultado_desc->fetchAll(PDO::FETCH_ASSOC);
$movimento = $dados_desc[0]['descricao'];

$res_atend = $pdo->query("SELECT * from atendimentos where id = '$movimento'");
$dados_atend = $res_atend->fetchAll(PDO::FETCH_ASSOC);
$nome_movimento = $dados_atend[0]['descricao'];




$resultado = $pdo->prepare("INSERT into movimentacoes (tipo, movimento, valor, tesoureiro, data, id_receber, id_pagar, id_pagamentos) values (:tipo, :movimento, :valor, :tesoureiro, curDate(), :id_receber, :id_pagar, :id_pagamentos)");

$resultado->bindValue(":tipo", 'Entrada');
$resultado->bindValue(":movimento", $nome_movimento);
$resultado->bindValue(":valor", $valor);
$resultado->bindValue(":tesoureiro", $func);
$resultado->bindValue(":id_receber", $id);
$resultado->bindValue(":id_pagar", NULL);
$resultado->bindValue(":id_pagamentos", NULL);

$resultado->execute();

echo "Editado com Sucesso!";




?>