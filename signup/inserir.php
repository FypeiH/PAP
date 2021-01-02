<?php 

require_once("../conexao.php");

$nome = $_POST['nome'];
$nif = $_POST['nif'];
// $cc = $_POST['cc'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
// $estado_civil = $_POST['estado_civil'];
$sexo = $_POST['sexo'];
// $endereco = $_POST['endereco'];
$password = $_POST['password'];
$password_confirmar = $_POST['password_confirmar'];


//Script para as fotos na base de dados

$caminho = '../../img/fotos-perfil/' .$_FILES['foto']['name'];

if ($_FILES['foto']['name'] == ""){
	$imagem = "sem-foto.png";
}else{
	$imagem = $_FILES['foto']['name']; 
}

$imagem_temp = $_FILES['foto']['tmp_name']; 
move_uploaded_file($imagem_temp, $caminho);


//Calcular a idade do paciente

if($data_nascimento != '')
{    
    list($ano, $mes, $dia) = explode('-', $data_nascimento); //Separar a data por yyyy, mm, dd
    
    $data_atual = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

    $idade = floor((((($data_atual - $nascimento) / 60) / 60) / 24) / 365.25);
}
else
{
	$idade = 0;	
}

//Buscar as obs do paciente
$resultado_obs = $pdo->query("SELECT * from pacientes where nif = '$nif'");
$dados_obs = $resultado_obs->fetchAll(PDO::FETCH_ASSOC);
@$obs = $dados_obs[0]['obs'];

//Buscar as obs do paciente
$resultado_pac = $pdo->query("SELECT * from pacientes where nif = '$nif'");
$dados_pac = $resultado_pac->fetchAll(PDO::FETCH_ASSOC);
@$nif_pac = $dados_pac[0]['nif'];

if($nif != $nif_pac && $password == $password_confirmar && strlen($password)>=8)
{

	$resultado = $pdo->prepare("INSERT into pacientes (nome, nif, cc, telefone, email, data_nascimento, idade, estado_civil, sexo, endereco, password) values (:nome, :nif, :cc, :telefone, :email, :data_nascimento, :idade, :estado_civil, :sexo, :endereco, :password)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", NULL);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":idade", $idade);
	$resultado->bindValue(":estado_civil", NULL);
	$resultado->bindValue(":sexo", $sexo);
	$resultado->bindValue(":endereco", NULL);
	$resultado->bindValue(":password",md5($password));

	$resultado->execute();


	//Registar na tabela Utilizadores

	$resultado = $pdo->prepare("INSERT into utilizadores (nome, email, nif, telefone, cedula, especialidade, turno, password, nivel, foto, estado_conta) values (:nome, :email, :nif, :telefone, :cedula, :especialidade, :turno, :password, :nivel, :foto, :estado_conta)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":cedula", NULL);
	$resultado->bindValue(":especialidade", NULL);
	$resultado->bindValue(":turno", NULL);
	$resultado->bindValue(":password",md5($password));
	$resultado->bindValue(":nivel", 'Paciente');
	$resultado->bindValue(":foto", $imagem);
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();

	header("location:../confirm_signin.php");


}
if($nif == $nif_pac && $password == $password_confirmar && strlen($password)>=8)
{

	$resultado = $pdo->prepare("UPDATE pacientes set nome = :nome, nif = :nif, telefone = :telefone, email = :email, data_nascimento = :data_nascimento, idade = :idade, sexo = :sexo, password = :password where nif = :nif");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":idade", $idade);
	$resultado->bindValue(":sexo", $sexo);
	$resultado->bindValue(":password", md5($password));
	
	$resultado->execute();

	//Registar na tabela Utilizadores

	$resultado = $pdo->prepare("INSERT into utilizadores (nome, email, nif, telefone, cedula, especialidade, turno, password, nivel, estado_conta) values (:nome, :email, :nif, :telefone, :cedula, :especialidade, :turno, :password, :nivel, :estado_conta)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":cedula", NULL);
	$resultado->bindValue(":especialidade", NULL);
	$resultado->bindValue(":turno", NULL);
	$resultado->bindValue(":password",md5($password));
	$resultado->bindValue(":nivel", 'Paciente');
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();

	header("location:../confirm_signin.php");

}
if($password != $password_confirmar)
{
	echo "<script language='javascript'>window.alert('As passwords não coincidem!'); </script>";
	echo "<script language='javascript'>window.location='../signin.php'; </script>";
}
if(strlen($password)<8)
{
	echo "<script language='javascript'>window.alert('A password tem de ter mais de 8 caracteres!'); </script>";
	echo "<script language='javascript'>window.location='../signin.php'; </script>";
}


?>

