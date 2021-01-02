<?php 

require_once("../../conexao.php");

@session_start();


$nome = $_POST['nome'];
$nif = $_POST['nif'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$turno = $_POST['turno'];
$password = $_POST['password'];
@$confirmar_password = $_POST['confirmar_password'];
@$foto = $_POST['foto'];
$campo_antigo = $_POST['campo_antigo'];
$password_antiga = $_POST['password_antiga'];



@$id = $_SESSION['id_utilizador'];

//Pesquisar os dados do registo a ser editado

$resultado = $pdo->query("SELECT * from utilizadores where id = '$id'");

$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$foto_original = $dados[0]['foto'];



//Script para as fotos na base de dados

$caminho = '../../img/fotos-perfil/' .$_FILES['foto']['name'];

if ($_FILES['foto']['name'] == ""){
	$imagem = $foto_original;
}else{
	$imagem = $_FILES['foto']['name']; 
}

$imagem_temp = $_FILES['foto']['tmp_name']; 
move_uploaded_file($imagem_temp, $caminho);


//Buscar o id do cargo
$resultado_cargo = $pdo->query("SELECT * from cargos where nome = 'Recepcionista' or nome = 'recepcionista'");
$dados_cargo = $resultado_cargo->fetchAll(PDO::FETCH_ASSOC);
$id_cargo = $dados_cargo[0]['id'];


if($campo_antigo != $nif)
{

//Verificar se o utilizador existe

	$resultado_verificar = $pdo->query("SELECT * from utilizadores where nif = '$nif'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "<script language='javascript'>window.alert('Este Utilizador já Existe!'); </script>";
		echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
		exit();

	}

}

if($password == "" && $confirmar_password == "")
{
	$resultado = $pdo->prepare("UPDATE utilizadores set nome = :nome, email = :email, nif = :nif, telefone = :telefone, cedula = :cedula, especialidade = :especialidade, turno = :turno, password = :password, nivel = :nivel, foto = :foto, estado_conta = :estado_conta where id = :id");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":especialidade", NULL);
	$resultado->bindValue(":cedula", NULL);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":id", $id);
	$resultado->bindValue(":password", $password_antiga);
	$resultado->bindValue(":turno", $turno);

	$nif_sem_pontos = preg_replace('/[^0-9]/', '', $nif);

	$resultado->bindValue(":nivel", 'Recepcionista');
	$resultado->bindValue(":foto", $imagem);
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();

	$resultado = $pdo->prepare("UPDATE funcionarios set nome = :nome, nif = :nif, telefone = :telefone, email = :email, cargo = :cargo where nif = :nif_antigo");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":cargo", $id_cargo);
	$resultado->bindValue(":nif_antigo", $campo_antigo);

	$resultado->execute();

	echo "<script language='javascript'>window.alert('Editado com Sucesso!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}
if($password == $confirmar_password && strlen($password)>=8)
{
	$resultado = $pdo->prepare("UPDATE utilizadores set nome = :nome, email = :email, nif = :nif, telefone = :telefone, cedula = :cedula, especialidade = :especialidade, turno = :turno, password = :password, nivel = :nivel, foto = :foto, estado_conta = :estado_conta where id = :id");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":especialidade", NULL);
	$resultado->bindValue(":cedula", NULL);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":id", $id);
	$resultado->bindValue(":turno", $turno);

	$nif_sem_pontos = preg_replace('/[^0-9]/', '', $nif);

	$resultado->bindValue(":password",md5($password));
	$resultado->bindValue(":nivel", 'Recepcionista');
	$resultado->bindValue(":foto", $imagem);
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();

	$resultado = $pdo->prepare("UPDATE funcionarios set nome = :nome, nif = :nif, telefone = :telefone, email = :email, cargo = :cargo where nif = :nif_antigo");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":cargo", $id_cargo);
	$resultado->bindValue(":nif_antigo", $campo_antigo);

	$resultado->execute();

	echo "<script language='javascript'>window.alert('Editado com Sucesso!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}


if($password != $confirmar_password)
{
	echo "<script language='javascript'>window.alert('As passwords não coincidem!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}
if(strlen($password)<8 && strlen($password)>1)
{
	echo "<script language='javascript'>window.alert('A password tem de ter mais de 8 caracteres!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}


?>