<?php 

require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$campo_antigo = $_POST['campo_antigo'];

if($campo_antigo != $nome)
{

//Verificar se o médico existe

	$resultado_verificar = $pdo->query("SELECT * from cargos where nome = '$nome'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Cargo Já Existe!";
		exit();

	}

}



$resultado = $pdo->prepare("UPDATE cargos set nome = :nome where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":id", $id);

$resultado->execute();

echo "Editado com Sucesso!";




?>