<?php 

require_once("../../conexao.php");
@session_start();

$id = $_POST['id'];

$email_utilizador = $_SESSION['email_utilizador'];

//Buscar o nif do utilizador logado

$resultado_ex = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and email = '$email_utilizador'");
$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
$func = $dados_ex[0]['id'];


$pdo->query("UPDATE contas_pagar set pagamento = curDate(), pago = 'Sim', funcionario = '$func' where id = '$id'");


echo "Editado com Sucesso!";




?>