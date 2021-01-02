<?php 

require_once("conexao.php");

$nome = $_POST['nome'];
$nif = $_POST['nif'];
$cc = $_POST['cc'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$estado_civil = $_POST['estado_civil'];
$sexo = $_POST['sexo'];
$endereco = $_POST['endereco'];
$password = $_POST['password'];


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


//Buscar o id do cargo
$resultado_pac = $pdo->query("SELECT * from pacientes where nif = '$nif'");
$dados_pac = $resultado_pac->fetchAll(PDO::FETCH_ASSOC);
$nif_pac = $dados_pac[0]['nif'];

//Buscar as obs do paciente
$resultado_obs = $pdo->query("SELECT * from pacientes where nif = '$nif'");
$dados_obs = $resultado_obs->fetchAll(PDO::FETCH_ASSOC);
$obs = $dados_pac[0]['obs'];


if($nif_pac != $nif)
{

	$resultado = $pdo->prepare("INSERT into pacientes (nome, nif, cc, telefone, email, data_nascimento, idade, estado_civil, sexo, endereco, password, obs) values (:nome, :nif, :cc, :telefone, :email, :data_nascimento, :idade, :estado_civil, :sexo, :endereco, :password, :obs)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", $cc);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":idade", $idade);
	$resultado->bindValue(":estado_civil", $estado_civil);
	$resultado->bindValue(":sexo", $sexo);
	$resultado->bindValue(":endereco", $endereco);
	$resultado->bindValue(":password", md5($password));
	$resultado->bindValue(":obs", NULL);

	$resultado->execute();
	


	echo "Registado com Sucesso!";

}

header("location:index.php");


?>

