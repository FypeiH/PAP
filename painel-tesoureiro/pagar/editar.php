<?php 

require_once("../../conexao.php");
@session_start();

$id = $_POST['id'];

$email_utilizador = $_SESSION['email_utilizador'];

//Buscar o id do utilizador logado

$resultado_ex = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and email = '$email_utilizador'");
$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
$func = $dados_ex[0]['id'];


$pdo->query("UPDATE contas_pagar set pagamento = curDate(), pago = 'Sim', funcionario = '$func' where id = '$id'");


echo "Editado com Sucesso!";


//Lançar para a tabela de Movimentações

//Buscar o ultimo id que foi inserido na tabela conta a pagar

$resultado_valor = $pdo->query("SELECT * from contas_pagar where id = '$id'");
$dados_valor = $resultado_valor->fetchAll(PDO::FETCH_ASSOC);
$valor = $dados_valor[0]['valor'];

$resultado_desc = $pdo->query("SELECT * from contas_pagar where id = '$id'");
$dados_desc = $resultado_desc->fetchAll(PDO::FETCH_ASSOC);
$movimento = $dados_desc[0]['descricao'];


$resultado = $pdo->prepare("INSERT into movimentacoes (tipo, movimento, valor, tesoureiro, data, id_receber, id_pagar, id_pagamentos) values (:tipo, :movimento, :valor, :tesoureiro, curDate(), :id_receber, :id_pagar, :id_pagamentos)");

$resultado->bindValue(":tipo", 'Saída');
$resultado->bindValue(":movimento", $movimento);
$resultado->bindValue(":valor", $valor);
$resultado->bindValue(":tesoureiro", $func);
$resultado->bindValue(":id_receber", NULL);
$resultado->bindValue(":id_pagar", $id);
$resultado->bindValue(":id_pagamentos", NULL);

$resultado->execute();




?>