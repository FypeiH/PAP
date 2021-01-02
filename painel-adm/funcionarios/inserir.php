<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];
$nif = $_POST['nif'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$cargo = $_POST['cargo'];


  //Verificar se o funcionario existe

$resultado_verificar = $pdo->query("SELECT * from funcionarios where nif = '$nif'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);

if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into funcionarios (nome, nif, telefone, email, cargo) values (:nome, :nif, :telefone, :email, :cargo)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":cargo", $cargo);

	$resultado->execute();


	echo "Registado com Sucesso!";

}
else
{
	echo "Este Funcionário Já Existe!";
}


?>