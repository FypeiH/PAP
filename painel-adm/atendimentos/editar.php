<?php 

require_once("../../conexao.php");

$id = $_POST['id'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];

$campo_antigo = $_POST['campo_antigo'];

if($campo_antigo != $descricao)
{

//Verificar se o médico existe

	$resultado_verificar = $pdo->query("SELECT * from atendimentos where descricao = '$descricao'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Registo Já Existe!";
		exit();

	}

}



$resultado = $pdo->prepare("UPDATE atendimentos set descricao = :descricao, valor = :valor where id = :id");

$resultado->bindValue(":descricao", $descricao);
$resultado->bindValue(":valor", $valor);
$resultado->bindValue(":id", $id);


$resultado->execute();

echo "Editado com Sucesso!";




?>