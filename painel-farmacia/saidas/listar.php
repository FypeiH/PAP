<?php 

require_once("../../conexao.php");
$pagina = 'saidas';

$txtpesquisar = @$_POST['txtpesquisar'];
$data = @$_POST['data'];


echo '
<table class="table table-sm mt-3">
  <thead class="thead-light">
    <tr>
      <th scope="col">Remédio</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Farmacêutico</th>
      <th scope="col">Data</th>
      
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>';




    $txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';

    $res = $pdo->query("SELECT * from saidas_remedios where remedio LIKE '$txtpesquisar' and data = '$data' order by id desc");
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);


  for ($i=0; $i < count($dados); $i++) { 
      foreach ($dados[$i] as $key => $value) {
      }

      $id = $dados[$i]['id']; 
      $remedio = $dados[$i]['remedio'];
      $quantidade = $dados[$i]['quantidade'];
      $farmaceutico = $dados[$i]['farmaceutico'];
      $data = $dados[$i]['data'];
      $data2 = implode('/', array_reverse(explode('-', $data)));

      //Buscar o nome dos remedios
      $resultado_rem = $pdo->query("SELECT * from remedios where id = '$remedio'");
      $dados_rem = $resultado_rem->fetchAll(PDO::FETCH_ASSOC);
      @$nome_rem = $dados_rem[0]['nome'];

      //Buscar o nome do farmaceutico
      $resultado_farm = $pdo->query("SELECT * from utilizadores where id = '$farmaceutico' and nivel = 'Farmacêutico'");
      $dados_farm = $resultado_farm->fetchAll(PDO::FETCH_ASSOC);
      @$nome_farm = $dados_farm[0]['nome'];
      


echo '
    <tr>

      <td>'.$nome_rem.'</td>
      <td>'.$quantidade.'</td>
      <td>'.$nome_farm.'</td>
      <td>'.$data2.'</td>
      
      <td>
        <a href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="fas fa-trash-alt text-danger"></i></a>
      </td>
    </tr>';

  }

echo  '
  </tbody>
</table> ';



?>