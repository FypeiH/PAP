<?php 

require_once("../../conexao.php");

$nome = $_POST['nome'];
$nif = $_POST['nif'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$remedios = $_POST['remedios'];



$id = $_POST['id'];
$campo_antigo = $_POST['campo_antigo'];


if($campo_antigo != $nif)
{

//Verificar se o fornecedor existe

	$resultado_verificar = $pdo->query("SELECT * from fornecedores where nif = '$nif'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Fornecedor Já Existe!";
		exit();

	}

}



$resultado = $pdo->prepare("UPDATE fornecedores set nome = :nome, nif = :nif, email = :email, telefone = :telefone, remedios = :remedios where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":remedios", $remedios);
$resultado->bindValue(":id", $id);

$resultado->execute();

echo "Editado com Sucesso!";




?>