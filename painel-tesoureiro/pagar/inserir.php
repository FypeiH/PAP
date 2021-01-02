<?php 

require_once("../../conexao.php");
@session_start();


$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];
$foto = $_POST['foto'];


//Script para as fotos na base de dados

$caminho = '../img/' .$_FILES['foto']['name'];
   
    if ($_FILES['foto']['name'] == ""){
      $imagem = "sem-foto.png";
    }else{
      $imagem = $_FILES['foto']['name']; 
    }
    
    $imagem_temp = $_FILES['foto']['tmp_name']; 
    move_uploaded_file($imagem_temp, $caminho);




$email_utilizador = $_SESSION['email_utilizador'];

//Buscar o nif do utilizador logado

$resultado_ex = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and email = '$email_utilizador'");
$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
$func = $dados_ex[0]['id'];


if($descricao == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($valor == '')
{
	echo "Preencha o Campo!";
	exit();
}



	$resultado = $pdo->prepare("INSERT into contas_pagar (descricao, valor, vencimento, pago, funcionario, foto) values (:descricao, :valor, :vencimento, :pago, :funcionario, :foto)");

	$resultado->bindValue(":descricao", $descricao);
	$resultado->bindValue(":valor", $valor);
	$resultado->bindValue(":vencimento", $data);
	$resultado->bindValue(":pago", 'Não');
	$resultado->bindValue(":funcionario", $func);
	$resultado->bindValue(":foto", $imagem);

	$resultado->execute();



	echo "Registado com Sucesso!";


?>