<?php 

require_once("../../conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];



$id = $_POST['id'];
$campo_antigo = $_POST['campo_antigo'];


if($campo_antigo != $nome)
{

//Verificar se o Paciente existe

	$resultado_verificar = $pdo->query("SELECT * from remedios where nome = '$nome'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Remédio Já Existe!";
		exit();

	}

}



$resultado = $pdo->prepare("UPDATE remedios set nome = :nome, descricao = :descricao where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":descricao", $descricao);
$resultado->bindValue(":id", $id);

$resultado->execute();

echo "Editado com Sucesso!";




?>