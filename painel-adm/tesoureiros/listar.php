<?php 

require_once("../../conexao.php");
$pagina = 'tesoureiros';

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Nome</th>
<th scope="col">Email</th>
<th scope="col">NIF</th>
<th scope="col">Telefone</th>
<th scope="col">Turno</th>
<th scope="col">Estado</th>

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
  $res = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' order by id desc LIMIT $limite, $itens_por_pagina");
}else{
  $txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
  $res = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro' and nome LIKE '$txtpesquisar'  order by id desc");

}

$dados = $res->fetchAll(PDO::FETCH_ASSOC);


  //Totalizar os Registos para a Paginação 
$res_todos = $pdo->query("SELECT * from utilizadores where nivel = 'Tesoureiro'");
$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
$num_total = count($dados_total);

    //Definir o Total de Páginas
$num_paginas = ceil($num_total/$itens_por_pagina);


for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $nome = $dados[$i]['nome'];
  $email = $dados[$i]['email'];
  $nif = $dados[$i]['nif'];
  $telefone = $dados[$i]['telefone'];
  $turno = $dados[$i]['turno'];
  $estado_conta = $dados[$i]['estado_conta'];

  


  echo '
  <tr>

  
  <td>'.$nome.'</td>
  <td>'.$email.'</td>
  <td>'.$nif.'</td>
  <td>'.$telefone.'</td>
  <td>'.$turno.'</td>
  <td>'.$estado_conta.'</td>
  
  <td>';

if($estado_conta == 'Inativo')
{
    echo'
    <a href="index.php?acao='.$pagina.'&funcao=mudar_nivel&id='.$id.'"><i class="fas fa-exchange-alt text-light mr-1"></i></a>
    <a href="index.php?acao='.$pagina.'&funcao=editar&id='.$id.'"><i class="fas fa-edit text-light"></i></a>
    <a href="index.php?acao='.$pagina.'&funcao=ativar&id='.$id.'"><i class="fas fa-check-circle text-success mr-1" title="Ativar Conta"></i></a>
    ';
}
if($estado_conta == 'Ativo')
{
    echo'
    <a href="index.php?acao='.$pagina.'&funcao=mudar_nivel&id='.$id.'"><i class="fas fa-exchange-alt text-light mr-1"></i></a>
    <a href="index.php?acao='.$pagina.'&funcao=editar&id='.$id.'"><i class="fas fa-edit text-light"></i></a>
    <a href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="fas fa-times-circle text-danger"></i></a>
      </td>
    ';
}

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