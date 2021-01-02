<?php 

require_once("../../conexao.php");
$pagina = 'marcacoes';

$txtpesquisar = @$_POST['txtpesquisar-paciente'];


if($txtpesquisar != '')
{

	echo '
	<table class="table table-sm" width="250px">
	<thead class="thead-light">
	<tr>
	<th scope="col">Nome</th>
	<th scope="col">NIF</th>

	<th scope="col">Ações</th>
	</tr>
	</thead>
	<tbody>';

	$txtpesquisar = '%'.@$_POST['txtpesquisar-paciente'].'%';
	$resultado = $pdo->query("SELECT * from pacientes where nif LIKE '$txtpesquisar' order by id desc LIMIT 1");


	$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);


	for ($i=0; $i < count($dados); $i++) { 
		foreach ($dados[$i] as $key => $value) {
		}

		$id = $dados[$i]['id']; 
		$nome = $dados[$i]['nome'];
		$nif = $dados[$i]['nif'];



		echo '
		<tr>

		<td>'.$nome.'</td>
		<td>'.$nif.'</td>

		<td><a id="btn-selecionar"><i class="fas fa-check-circle text-success"></i></a></td>
		</tr>';

	}

	echo  '
	</tbody>
	</table> ';

}



?>



<script type="text/javascript">

  $(document).ready(function(){
    
	
    $('#btn-selecionar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      var id = "<?=$id?>";
      var nome = "<?=$nome?>";


      document.getElementById('txtpesquisar-paciente').value = nome;
      document.getElementById('id').value = id;

      document.getElementById('listar-pacientes').style.display = "none";

      //document.getElementById('txtpesquisar-paciente').value = '';
    })
  })

</script>