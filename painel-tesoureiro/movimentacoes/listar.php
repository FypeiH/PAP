<?php 

@session_start();

require_once("../../conexao.php");
$pagina = 'movimentacoes';

$txtpesquisar = @$_POST['txtpesquisar'];
$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];

$data_atual = date('Y-m-d');

$total_entradas = 0;
$total_saídas = 0;



echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Tipo</th>
<th scope="col">Movimento</th>
<th scope="col">Valor</th>
<th scope="col">Tesoureiro</th>
<th scope="col">Data</th>
</tr>
</thead>
<tbody>';


  
  $txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
  $res = $pdo->query("SELECT * from movimentacoes where tipo LIKE '$txtpesquisar' and (data >= '$dataInicial' and data <= '$dataFinal') order by id asc");


$dados = $res->fetchAll(PDO::FETCH_ASSOC);



for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $tipo = $dados[$i]['tipo'];
  $valor = $dados[$i]['valor'];
  $data = $dados[$i]['data'];
  $movimento = $dados[$i]['movimento'];
  $tesoureiro = $dados[$i]['tesoureiro'];
  $data2 = implode('/', array_reverse(explode('-', $data)));

  if($tipo == 'Entrada'){

    @$total_entradas = $total_entradas + $valor;

  }else{

    @$total_saídas = $total_saídas + $valor;

  }
  

  //Buscar o nome do tesoureiro
  $res_excluir = $pdo->query("SELECT * from utilizadores where id = '$tesoureiro'");
  $dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
  $nome_tesoureiro = $dados_excluir[0]['nome'];


  echo '
  <tr>


  <td>'.$tipo.'</td>
  <td>'.$movimento.'</td>
  <td>'.$valor.'€</td>
  <td>'.$nome_tesoureiro.'</td>
  <td>'.$data2.'</td>


</tr>';

    

}


@$total = $total_entradas - $total_saídas;

echo  '
</tbody>
</table> 


<div class="row">
<div class="col-md-9">
<div class="float-left totalpago text-light"><span class="mr-4 alert alert-success">Total Entradas: '.@$total_entradas.'€</span> <span class="alert alert-danger">Total Saídas: '.@$total_saídas.'€</span></div>
</div>
<div class="col-md-3">';

if($total > 0)
{
  echo'
  <div align="right" class="float-right totalpago alert alert-success">Total: '.@$total.'€</div>';
}
if($total == 0)
{
  echo'
  <div align="right" class="float-right totalpago alert alert-light">Total: '.@$total.'€</div>';
}
if($total < 0)
{
  echo'
  <div align="right" class="float-right totalpago alert alert-danger">Total: '.@$total.'€</div>';
}



echo'
</div>
</div>
';



?>