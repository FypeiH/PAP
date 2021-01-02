<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];


  //Verificar se o médico existe

$resultado_verificar = $pdo->query("SELECT * from especialidades where nome = '$nome'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($nome == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into especialidades (nome) values (:nome)");

	$resultado->bindValue(":nome", $nome);

	$resultado->execute();

	echo "Registado com Sucesso!";

}
else
{
	echo "Esta Especialidade Já Existe!";
}


?>