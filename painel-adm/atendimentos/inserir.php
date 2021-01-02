<?php 

require_once("../../conexao.php");


$descricao = $_POST['descricao'];
$valor = $_POST['valor'];


  //Verificar se o médico existe

$resultado_verificar = $pdo->query("SELECT * from atendimentos where descricao = '$descricao'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($descricao == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into atendimentos (descricao, valor) values (:descricao, :valor)");

	$resultado->bindValue(":descricao", $descricao);
	$resultado->bindValue(":valor", $valor);

	$resultado->execute();

	echo "Registado com Sucesso!";

}
else
{
	echo "Este Registo Já Existe!";
}


?>