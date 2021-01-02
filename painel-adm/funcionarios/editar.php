<?php 

require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$nif = $_POST['nif'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$nif_antigo = $_POST['nif_antigo'];
$cargo = $_POST['cargo'];

if($nif_antigo != $nif)
{

//Verificar se o funcionário existe

	$resultado_verificar = $pdo->query("SELECT * from funcionarios where nif = '$nif'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Funcionário Já Existe!";
		exit();

	}

}



$resultado = $pdo->prepare("UPDATE funcionarios set nome = :nome, nif = :nif, telefone = :telefone, email = :email, cargo = :cargo where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":id", $id);
$resultado->bindValue(":cargo", $cargo);

$resultado->execute();

echo "Editado com Sucesso!";




?>