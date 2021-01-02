<?php 

require_once("../../conexao.php");

$medico = $_POST['medico'];
$data = $_POST['data'];
$hora = $_POST['hora'];


$id = $_POST['id'];


//Verificar se o horário, data e médico estão disponíveis

	$resultado_verificar = $pdo->query("SELECT * from consultas where data = '$data' and hora = '$hora' and medico = '$medico'");
	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Horário não está Disponível!";
		exit();

	}



$resultado = $pdo->prepare("UPDATE consultas set data = :data, hora = :hora, medico = :medico where id = :id");

$resultado->bindValue(":data", $data);
$resultado->bindValue(":hora", $hora);
$resultado->bindValue(":medico", $medico);
$resultado->bindValue(":id", $id);

$resultado->execute();

echo "Editado com Sucesso!";




?>