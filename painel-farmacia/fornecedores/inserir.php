<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];
$nif = $_POST['nif'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$remedios = $_POST['remedios'];


//Verificar se o fornecedor existe

$resultado_verificar = $pdo->query("SELECT * from fornecedores where nif = '$nif'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($nome == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($nif == '')
{
	echo "Preencha o Campo!";
	exit();
}


if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into fornecedores (nome, nif, email, telefone, remedios) values (:nome, :nif, :email, :telefone, :remedios)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":remedios", $remedios);

	$resultado->execute();
	


	echo "Registado com Sucesso!";

}
else
{
	echo "Este Fornecedor Já Existe!";
}


?>