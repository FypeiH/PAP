<?php 

require_once("../../conexao.php");
$pagina = 'pagar';

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Descrição</th>
<th scope="col">Valor</th>
<th scope="col">Pagamento</th>
<th scope="col">Pago</th>
<th scope="col">Funcionário</th>
<th scope="col">Foto</th>

<th scope="col">Ações</th>
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
  $res = $pdo->query("SELECT * from contas_pagar order by id desc LIMIT $limite, $itens_por_pagina");
}else{
  $txtpesquisar = @$_POST['txtpesquisar'];
  $res = $pdo->query("SELECT * from contas_pagar where vencimento = '$txtpesquisar' order by id asc");

}

$dados = $res->fetchAll(PDO::FETCH_ASSOC);


  //Totalizar os Registos para a Paginação 
$res_todos = $pdo->query("SELECT * from contas_pagar");
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
  $pagamento = $dados[$i]['pagamento'];
  $pago = $dados[$i]['pago'];
  $funcionario = $dados[$i]['funcionario'];
  $foto = $dados[$i]['foto'];

  $pagamento2 = implode('/', array_reverse(explode('-', $pagamento)));

  //Buscar o nome do funcionário

  $resultado_ex = $pdo->query("SELECT * from utilizadores where id = '$funcionario'");
  $dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);
  $nome = $dados_ex[0]['nome'];




  echo '
  <tr>


  <td>'.$descricao.'</td>
  <td>'.$valor.'€</td>
  <td>'.$pagamento2.'</td>
  <td>'.$pago.'</td>
  <td>'.$nome.'</td>
  <td><a href="img/'.$foto.'" target="_blank"><img src="img/'.$foto.'" width="50px"></a></td><td>';

  if($pago != 'Sim')
  {
    echo '
    
    <a title="Confirmar Pagamento" href="index.php?acao='.$pagina.'&funcao=confirmar&id='.$id.'"><i class="fas fa-check-square text-success"></i></a>
    <a title="Excluir Conta" href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="fas fa-trash-alt text-danger"></i></a>
    ';  
  }

  echo '</td></tr>';

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