<?php 

require_once("../../conexao.php");

$nome = $_POST['nome'];
$nif = $_POST['nif'];
$cc = $_POST['cc'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$estado_civil = $_POST['estado_civil'];
$sexo = $_POST['sexo'];
$endereco = $_POST['endereco'];
$obs = $_POST['obs'];


$id = $_POST['id'];
$campo_antigo = $_POST['campo_antigo'];


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


if($campo_antigo != $nif)
{

//Verificar se o médico existe

	$resultado_verificar = $pdo->query("SELECT * from pacientes where nif = '$nif'");

	$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_verificar);

	if($linhas != 0)
	{

		echo "Este Paciente Já Existe!";
		exit();

	}

}



$resultado = $pdo->prepare("UPDATE pacientes set nome = :nome, nif = :nif, cc = :cc, telefone = :telefone, email = :email, data_nascimento = :data_nascimento, idade = :idade, estado_civil = :estado_civil, sexo = :sexo, endereco = :endereco, obs = :obs where id = :id");

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
$resultado->bindValue(":obs", $obs);
$resultado->bindValue(":id", $id);

$resultado->execute();

echo "Editado com Sucesso!";




?>