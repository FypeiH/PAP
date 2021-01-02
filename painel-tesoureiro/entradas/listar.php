<?php 

require_once("../../conexao.php");
$pagina = 'entradas';

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Descrição</th>
<th scope="col">Valor</th>
<th scope="col">Vencimento</th>
<th scope="col">Forma de Pagamento</th>
<th scope="col">Paciente</th>
<th scope="col">Tesoureiro</th>

<th scope="col">Confirmação</th>
</tr>
</thead>
<tbody>';


$itens_por_pagina = $_POST['itens'];

//Buscar a página atual
$pagina_pag = intval(@$_POST['pag']);

$limite = $pagina_pag * $itens_por_pagina;

    //Caminho da paginação
$caminho_pag = 'index.php?acao='.$pagina.'&';

if($txtpesquisar == ''){
  $res = $pdo->query("SELECT * from contas_receber where vencimento = curDate() order by id desc LIMIT $limite, $itens_por_pagina");
}else{
  $txtpesquisar = @$_POST['txtpesquisar'];
  $res = $pdo->query("SELECT * from contas_receber where vencimento = '$txtpesquisar'  order by id desc");

}

$dados = $res->fetchAll(PDO::FETCH_ASSOC);


  //Totalizar os Registos para a Paginação 
$res_todos = $pdo->query("SELECT * from contas_receber");
$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
$num_total = count($dados_total);

    //Definir o Total de Páginas
$num_paginas = ceil($num_total/$itens_por_pagina);


for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $descricao = $dados[$i]['descricao'];
  $valor = $dados[$i]['valor'];
  $vencimento = $dados[$i]['vencimento'];
  $data_baixa = $dados[$i]['data_baixa'];
  $forma_pagamento = $dados[$i]['forma_pagamento'];
  $tipo_pagamento = $dados[$i]['tipo_pagamento'];
  $tesoureiro = $dados[$i]['tesoureiro'];
  $id_consulta = $dados[$i]['id_consulta'];

  $vencimento2 = implode('/', array_reverse(explode('-', $vencimento)));

  if($forma_pagamento == '')
  {
    $forma_pagamento = 'Pendente';
  }


      //Recuperar o id do paciente

  $resultado_p = $pdo->query("SELECT * from consultas where id = '$id_consulta'");
  $dados_p = $resultado_p->fetchAll(PDO::FETCH_ASSOC);
  $id_paciente = $dados_p[0]['paciente'];

      //Recuperar o nome do paciente

  $resultado_paciente = $pdo->query("SELECT * from pacientes where id = '$id_paciente'");
  $dados_paciente = $resultado_paciente->fetchAll(PDO::FETCH_ASSOC);
  $paciente = $dados_paciente[0]['nome'];

      //Recuperar o nome do Atendimento

  $resultado_desc = $pdo->query("SELECT * from atendimentos where id = '$descricao'");
  $dados_desc = $resultado_desc->fetchAll(PDO::FETCH_ASSOC);
  $atendimento = $dados_desc[0]['descricao'];

  //Recuperar o nome do Tesoureiro

  $resultado_tesoureiro = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and id = '$tesoureiro'");
  $dados_tesoureiro = $resultado_tesoureiro->fetchAll(PDO::FETCH_ASSOC);
  $nome_tesoureiro = @$dados_tesoureiro[0]['nome'];


  echo '
  <tr>


  <td>'.$atendimento.'</td>
  <td>'.$valor.'€</td>
  <td>'.$vencimento2.'</td>
  <td>'.$forma_pagamento.'</td>
  <td>'.$paciente.'</td> 
  <td>'.$nome_tesoureiro.'</td>';

  if($forma_pagamento != 'Pendente')
  {
    echo '
    <td>
    Pago!
    </td>';
  }
  else
  {
   echo '
   <td>
   <a href="index.php?acao=entradas&funcao=editar&id='.$id.'&id_consulta='.$id_consulta.'"><i class="fas fa-check-circle text-success"></i></a>
   </td> ';
 }

 echo '</tr>';

}

echo  '
</tbody>
</table> ';


if($txtpesquisar == ''){


  echo '
  <!--Área de Paginação-->

  <nav class="paginacao" aria-label="Page navigation example">
  <ul class="pagination">
  <li class="page-item">
  <a class="btn btn-outline-light btn-sm mr-1" href="'.$caminho_pag.'pagina=0&itens='.$itens_por_pagina.'" aria-label="Previous">
  <span aria-hidden="true">&laquo;</span>
  <span class="sr-only">Previous</span>
  </a>
  </li>';

  for($i=0;$i<$num_paginas;$i++)
  {
    $estilo = "";
    if($pagina_pag == $i)
    {
      $estilo = "active";
    } 

    echo '
    <li class="page-item"><a class="btn btn-outline-light btn-sm mr-1 '.$estilo.'" href="'.$caminho_pag.'pagina='.$i.'&itens='.$itens_por_pagina.'">'.($i+1).'</a></li>';
  }

  echo '
  <li class="page-item">
  <a class="btn btn-outline-light btn-sm" href="'.$caminho_pag.'pagina='.($num_paginas-1).'&itens='.$itens_por_pagina.'" aria-label="Next">
  <span aria-hidden="true">&raquo;</span>
  <span class="sr-only">Next</span>
  </a>
  </li>
  </ul>
  </nav>


  ';

}


?>