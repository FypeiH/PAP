<?php 

require_once("../../conexao.php");
@session_start();


$remedio = $_POST['remedio'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];
$fornecedor = $_POST['fornecedor'];

$valor_total = $quantidade * $valor;

//Buscar o nome do remedio

$resultado_nome = $pdo->query("SELECT * from remedios where id = '$remedio'");
$dados_nome = $resultado_nome->fetchAll(PDO::FETCH_ASSOC);
$nome_remedio = $dados_nome[0]['nome'];

$email_utilizador = $_SESSION['email_utilizador'];

//Buscar o id do utilizador logado

$resultado_ex = $pdo->query("SELECT * from utilizadores where nivel = 'Farmacêutico' and email = '$email_utilizador'");
$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
$farmaceutico = $dados_ex[0]['id'];


if($remedio == '')
{
	echo "Selecione um Remédio!";
	exit();
}


$resultado = $pdo->prepare("INSERT into entradas_remedios (remedio, quantidade, valor, fornecedor, farmaceutico, data) values (:remedio, :quantidade, :valor, :fornecedor, :farmaceutico, curDate())");

$resultado->bindValue(":remedio", $remedio);
$resultado->bindValue(":quantidade", $quantidade);
$resultado->bindValue(":valor", $valor);
$resultado->bindValue(":fornecedor", $fornecedor);
$resultado->bindValue(":farmaceutico", $farmaceutico);

$resultado->execute();


	//Trazer o total de estoque do remédio inserido para poder adicionar a quantidade comprada


//Buscar o estoque do remedio

$resultado_rem = $pdo->query("SELECT * from remedios where id = '$remedio'");
$dados_rem = $resultado_rem->fetchAll(PDO::FETCH_ASSOC);
$quant_remedio = $dados_rem[0]['estoque'];


$quantidade_total = $quant_remedio + $quantidade;


$resultado = $pdo->query("UPDATE remedios set estoque = '$quantidade_total' where id = '$remedio'"); 



//Lançar os valores para o pagamento na tabela compras a pagar

$resultado = $pdo->prepare("INSERT into contas_pagar (descricao, valor, vencimento, pago, funcionario, foto) values (:descricao, :valor, curDate(), :pago, :funcionario, :foto)");

	$resultado->bindValue(":descricao", 'Compra do/a '.$nome_remedio.'');
	$resultado->bindValue(":valor", $valor_total);
	$resultado->bindValue(":pago", 'Não');
	$resultado->bindValue(":funcionario", $farmaceutico);
	$resultado->bindValue(":foto", 'sem-foto.png');

	$resultado->execute();





echo "Registado com Sucesso!";


?>