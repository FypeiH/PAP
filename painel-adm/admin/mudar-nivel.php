<?php 

require_once("../../conexao.php");

$id = $_POST['id'];
$nivel = $_POST['nivel'];


$resultado = $pdo->prepare("UPDATE utilizadores set nivel = :nivel where id = :id");

$resultado->bindValue(":nivel", $nivel);
$resultado->bindValue(":id", $id);

$resultado->execute();

?>