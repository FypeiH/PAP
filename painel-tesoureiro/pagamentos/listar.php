<?php 

@session_start();

require_once("../../conexao.php");
$pagina = 'pagamentos';

$txtpesquisar = @$_POST['txtpesquisar'];
$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];

$data_atual = date('Y-m-d');

$email_utilizador = $_SESSION['email_utilizador'];

//Buscar o id do utilizador logado

$resultado_ex = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and email = '$email_utilizador'");
$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
$id_tesoureiro = $dados_ex[0]['id'];


echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Funcionário</th>
<th scope="col">Valor</th>
<th scope="col">Tesoureiro</th>
<th scope="col">Cargo</th>
<th scope="col">Data</th>

<th scope="col">Ações</th>
</tr>
</thead>
<tbody>';


$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
  $res = $pdo->query("SELECT * from pagamentos where funcionario LIKE '$txtpesquisar' and tesoureiro = '$id_tesoureiro' and (data >= '$dataInicial' and data <= '$dataFinal') order by id asc");


$dados = $res->fetchAll(PDO::FETCH_ASSOC);



for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $funcionario = $dados[$i]['funcionario'];
  $valor = $dados[$i]['valor'];
  $data = $dados[$i]['data'];
  $tesoureiro = $dados[$i]['tesoureiro'];
  $data2 = implode('/', array_reverse(explode('-', $data)));

  @$total = $total + $valor;

  //Buscar o nome do tesoureiro
  $res_excluir = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and id = '$tesoureiro'");
  $dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
  $nome_tesoureiro = $dados_excluir[0]['nome'];


  //Buscar o id do cargo do funcionario
  $res_func = $pdo->query("SELECT * from funcionarios where id = '$funcionario'");
  $dados_func = $res_func->fetchAll(PDO::FETCH_ASSOC);
  $id_cargo = $dados_func[0]['cargo'];

  //Buscar o id do cargo do funcionario
  $res_cargo = $pdo->query("SELECT * from cargos where id = '$id_cargo'");
  $dados_cargo = $res_cargo->fetchAll(PDO::FETCH_ASSOC);
  $cargo = $dados_cargo[0]['nome'];

  //Buscar o nome do cargo do funcionario
  $res_nomefunc = $pdo->query("SELECT * from funcionarios where id = '$funcionario'");
  $dados_nomefunc = $res_nomefunc->fetchAll(PDO::FETCH_ASSOC);
  $nome_funcionario = $dados_nomefunc[0]['nome'];


  echo '
  <tr>


  <td>'.$nome_funcionario.'</td>
  <td>'.$valor.'€</td>
  <td>'.$nome_tesoureiro.'</td>
  <td>'.$cargo.'</td>
  <td>'.$data2.'</td>

  <td>
   <a title="Excluir Conta" href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="far fa-trash-alt text-danger"></i></a>
  </td></tr>';

    

}

echo  '
</tbody>
</table> 


<div class="float-right totalpago alert alert-light">Total Pago: '.@$total.'€</div>



';



?>