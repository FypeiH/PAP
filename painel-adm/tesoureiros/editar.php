<?php 

require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$nif = $_POST['nif'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$turno = $_POST['turno'];
$campo_antigo = $_POST['campo_antigo'];


if($campo_antigo != $nif)
{

//Verificar se o utilizador existe

	$resultado_verificar = $pdo->query("SELECT * from utilizadores where nif = '$nif'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Utilizador Já Existe!";
		exit();

	}

}



$resultado = $pdo->prepare("UPDATE utilizadores set nome = :nome, email = :email, nif = :nif, telefone = :telefone, cedula = :cedula, especialidade = :especialidade, turno = :turno, password = :password, nivel = :nivel where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":especialidade", NULL);
$resultado->bindValue(":cedula", NULL);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":id", $id);
$resultado->bindValue(":turno", $turno);

$nif_sem_pontos = preg_replace('/[^0-9]/', '', $nif);

$resultado->bindValue(":password",md5($nif_sem_pontos));
$resultado->bindValue(":nivel", 'Tesoureiro');

$resultado->execute();


$resultado = $pdo->prepare("UPDATE funcionarios set nome = :nome, nif = :nif, telefone = :telefone, email = :email, cargo = :cargo where nif = :nif_antigo");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":cargo", 'Tesoureiro');
$resultado->bindValue(":nif_antigo", $campo_antigo);

$resultado->execute();


echo "Editado com Sucesso!";




?>