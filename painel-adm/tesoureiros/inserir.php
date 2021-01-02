<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];
$nif = $_POST['nif'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$turno = $_POST['turno'];
$foto = $_POST['foto'];

//Buscar o id do cargo
$resultado_cargo = $pdo->query("SELECT * from cargos where nome = 'Tesoureiro' or nome = 'tesoureiro'");
$dados_cargo = $resultado_cargo->fetchAll(PDO::FETCH_ASSOC);
$id_cargo = $dados_cargo[0]['id'];


//Script para as fotos na base de dados

$caminho = '../../img/fotos-perfil/' .$_FILES['foto']['name'];

if ($_FILES['foto']['name'] == ""){
	$imagem = "sem-foto.png";
}else{
	$imagem = $_FILES['foto']['name']; 
}

$imagem_temp = $_FILES['foto']['tmp_name']; 
move_uploaded_file($imagem_temp, $caminho);


  //Verificar se o médico existe

$resultado_verificar = $pdo->query("SELECT * from utilizadores where nif = '$nif'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($nome == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($nif == '')
{
	echo "Preencha o Campo!";
	exit();
}


if($linhas == 0)
{

	//Registar na tabela Utilizadores

	$resultado = $pdo->prepare("INSERT into utilizadores (nome, email, nif, telefone, cedula, especialidade, turno, password, nivel, foto, estado_conta) values (:nome, :email, :nif, :telefone, :cedula, :especialidade, :turno, :password, :nivel, :foto, :estado_conta)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":cedula", NULL);
	$resultado->bindValue(":especialidade", NULL);
	$resultado->bindValue(":turno", $turno);

	$nif_sem_pontos = preg_replace('/[^0-9]/', '', $nif);

	$resultado->bindValue(":password",md5($nif_sem_pontos));
	$resultado->bindValue(":nivel", 'Tesoureiro');
	$resultado->bindValue(":foto", $imagem);
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();


	if(empty($id_cargo))
	{

		$resultado = $pdo->prepare("INSERT into cargos (nome) values (:nome)");

		$resultado->bindValue(":nome", $nome);

		$resultado->execute();

	//Buscar o id do cargo
		$resultado_cargo_i = $pdo->query("SELECT * from cargos where nome = 'Tesoureiro' or nome = 'tesoureiro'");
		$dados_cargo_i = $resultado_cargo_i->fetchAll(PDO::FETCH_ASSOC);
		@$id_cargo_i = $dados_cargo_i[0]['id'];


	//Registar na tabela Funcionários

		$resultado = $pdo->prepare("INSERT into funcionarios (nome, nif, telefone, email, cargo) values (:nome, :nif, :telefone, :email, :cargo)");

		$resultado->bindValue(":nome", $nome);
		$resultado->bindValue(":nif", $nif);
		$resultado->bindValue(":telefone", $telefone);
		$resultado->bindValue(":email", $email);
		$resultado->bindValue(":cargo", $id_cargo_i);

		$resultado->execute();

	}
	else
	{
		//Registar na tabela Funcionários

		$resultado = $pdo->prepare("INSERT into funcionarios (nome, nif, telefone, email, cargo) values (:nome, :nif, :telefone, :email, :cargo)");

		$resultado->bindValue(":nome", $nome);
		$resultado->bindValue(":nif", $nif);
		$resultado->bindValue(":telefone", $telefone);
		$resultado->bindValue(":email", $email);
		$resultado->bindValue(":cargo", $id_cargo);

		$resultado->execute();
	}


	echo "Registado com Sucesso!";

}
else
{
	echo "Este Utilizador Já Existe!";
}


?>