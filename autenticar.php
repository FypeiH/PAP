<?php 

require_once("conexao.php");
@session_start();

if(empty($_POST['utilizador']) || empty($_POST['pass']))
{

	header("location:index.php");

}

$utilizador = $_POST['utilizador'];
$pass = md5($_POST['pass']);

$resultado = $pdo->prepare("SELECT * from utilizadores where email = :utilizador and password = :password");

$resultado->bindValue(":utilizador", $utilizador);
$resultado->bindValue(":password", $pass);
$resultado->execute();

$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);


if($linhas > 0)
{
	$_SESSION['id_utilizador'] = $dados[0]['id'];
	$_SESSION['nome_utilizador'] = $dados[0]['nome'];
	$_SESSION['email_utilizador'] = $dados[0]['email'];
	$_SESSION['nivel_utilizador'] = $dados[0]['nivel'];
	$_SESSION['estado_utilizador'] = $dados[0]['estado_conta'];

	if($_SESSION['nivel_utilizador'] == 'Admin' && $_SESSION['estado_utilizador'] == 'Ativo')
	{
		header("location:painel-escolha/admin.php");
		exit();
	}

	if($_SESSION['nivel_utilizador'] == 'Médico' && $_SESSION['estado_utilizador'] == 'Ativo')
	{
		header("location:painel-escolha/medico.php");
		exit();
	}

	if($_SESSION['nivel_utilizador'] == 'Recepcionista' && $_SESSION['estado_utilizador'] == 'Ativo')
	{
		header("location:painel-escolha/recepcionista.php");
		exit();
	}
	if($_SESSION['nivel_utilizador'] == 'Tesoureiro' && $_SESSION['estado_utilizador'] == 'Ativo')
	{
		header("location:painel-escolha/tesoureiro.php");
		exit();
	}
	if($_SESSION['nivel_utilizador'] == 'Farmacêutico' && $_SESSION['estado_utilizador'] == 'Ativo')
	{
		header("location:painel-escolha/farmaceutico.php" );
		exit();
	}
	if($_SESSION['nivel_utilizador'] == 'Paciente' && $_SESSION['estado_utilizador'] == 'Ativo')
	{
		header("location:painel-paciente/index.php");
		exit();
	}
	if($_SESSION['estado_utilizador'] == 'Inativo')
	{
		echo "<script language='javascript'>window.alert('Esta conta está inativa!'); </script>";
		echo "<script language='javascript'>window.location='index.php'; </script>";
	}

	
}
else
{
	echo "<script language='javascript'>window.alert('Dados Incorretos!'); </script>";
	echo "<script language='javascript'>window.location='index.php'; </script>";
}


?>