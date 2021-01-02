<?php 

require_once("../../conexao.php");
$pagina = 'fornecedores';

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">NIF</th>
      <th scope="col">Email</th>
      <th scope="col">Telefone</th>
      <th scope="col">Remédios</th>
      
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
    $res = $pdo->query("SELECT * from fornecedores order by id desc LIMIT $limite, $itens_por_pagina");
  }else{
    $txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
    $res = $pdo->query("SELECT * from fornecedores where nome LIKE '$txtpesquisar' order by id desc");

  }
  
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);


  //Totalizar os Registos para a Paginação 
    $res_todos = $pdo->query("SELECT * from fornecedores");
    $dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
    $num_total = count($dados_total);

    //Definir o Total de Páginas
    $num_paginas = ceil($num_total/$itens_por_pagina);


  for ($i=0; $i < count($dados); $i++) { 
      foreach ($dados[$i] as $key => $value) {
      }

      $id = $dados[$i]['id']; 
      $nome = $dados[$i]['nome'];
      $nif = $dados[$i]['nif'];
      $email = $dados[$i]['email'];
      $telefone = $dados[$i]['telefone'];
      $remedios = $dados[$i]['remedios'];

      //Buscar o nome da remedios
      $resultado_rem = $pdo->query("SELECT * from remedios where id = '$remedios'");
      $dados_rem = $resultado_rem->fetchAll(PDO::FETCH_ASSOC);
      @$nome_rem = $dados_rem[0]['nome'];
      


echo '
    <tr>

      <td>'.$nome.'</td>
      <td>'.$nif.'</td>
      <td>'.$email.'</td>
      <td>'.$telefone.'</td>
      <td>'.$nome_rem.'</td>
      
      <td>
        <a href="index.php?acao='.$pagina.'&funcao=editar&id='.$id.'"><i class="fas fa-edit text-light"></i></a>
        <a href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="fas fa-trash-alt text-danger"></i></a>
      </td>
    </tr>';

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