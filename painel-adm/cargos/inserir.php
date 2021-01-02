<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];


  //Verificar se o cargo existe

$resultado_verificar = $pdo->query("SELECT * from cargos where nome = '$nome'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($nome == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into cargos (nome) values (:nome)");

	$resultado->bindValue(":nome", $nome);

	$resultado->execute();

	echo "Registado com Sucesso!";

}
else
{
	echo "Este Cargo Já Existe!";
}


?>