<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];
$descricao = $_POST['descricao'];


//Verificar se o remédio existe

$resultado_verificar = $pdo->query("SELECT * from remedios where nome = '$nome'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($nome == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($descricao == '')
{
	echo "Preencha o Campo!";
	exit();
}


if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into remedios (nome, descricao) values (:nome, :descricao)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":descricao", $descricao);

	$resultado->execute();
	


	echo "Registado com Sucesso!";

}
else
{
	echo "Este Remédio Já Existe!";
}


?>