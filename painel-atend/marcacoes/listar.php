<?php 

require_once("../../conexao.php");
$pagina = 'marcacoes';

$txtpesquisar = @$_POST['txtpesquisar'];
$cbmedicos = @$_POST['cbmedicos'];

if($txtpesquisar == ''){
	$txtpesquisar = date('Y-m-d');

}


if($cbmedicos == '')
{
	$res = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' order by nome asc");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados);
	if($linhas > 0)
	{
		$cbmedicos = $dados[0]['id'];
	}

}


$classebtn = 'btn-success';

echo '
<div class="quadro">';

for($i=00;$i<24;$i++){


	$hora_testada = $i.':00';

	//Consultar na base de dados se o horário está disponivel
	$res_valor = $pdo->query("SELECT * from consultas where data = '$txtpesquisar' and medico = '$cbmedicos' and hora = '$hora_testada'");
	$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_valor);

	if($linhas > 0)
	{

		$classebtn = 'btn-danger';
		$disabled = 'disabled';

	}
	else
	{
		$classebtn = 'btn-success';
		$disabled = '';
	}

	if($i<10)
	{
		echo '<button class="btn '.$classebtn.' mr-2 mb-2" id="btn-hora" '.$disabled.' onclick="hora('.$i.')">0'.$i.':00</button>';
	}
	else
	{
		echo '<button class="btn '.$classebtn.' mr-2 mb-2" id="btn-hora" '.$disabled.' onclick="hora('.$i.')">'.$i.':00</button>';
	}

	$hora_testada30 = $i.':15';

	//Consultar na base de dados se o horário está disponivel
	$res_valor = $pdo->query("SELECT * from consultas where data = '$txtpesquisar' and medico = '$cbmedicos' and hora = '$hora_testada30'");
	$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_valor);

	if($linhas > 0)
	{

		$classebtn = 'btn-danger';
		$disabled = 'disabled';

	}
	else
	{
		$classebtn = 'btn-success';
		$disabled = '';
	}

	if($i<10)
	{
		echo '<button class="btn '.$classebtn.' mr-2 mb-2" id="btn-hora" '.$disabled.' onclick="hora0('.$i.')">0'.$i.':15</button>';
	}
	else
	{
		echo '<button class="btn '.$classebtn.' mr-2 mb-2" id="btn-hora" '.$disabled.' onclick="hora0('.$i.')">'.$i.':15</button>';
	}


	$hora_testada30 = $i.':30';

	//Consultar na base de dados se o horário está disponivel
	$res_valor = $pdo->query("SELECT * from consultas where data = '$txtpesquisar' and medico = '$cbmedicos' and hora = '$hora_testada30'");
	$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_valor);

	if($linhas > 0)
	{

		$classebtn = 'btn-danger';
		$disabled = 'disabled';

	}
	else
	{
		$classebtn = 'btn-success';
		$disabled = '';
	}

	if($i<10)
	{
		echo '<button class="btn '.$classebtn.' mr-2 mb-2" id="btn-hora" '.$disabled.' onclick="hora1('.$i.')">0'.$i.':30</button>';
	}
	else
	{
		echo '<button class="btn '.$classebtn.' mr-2 mb-2" id="btn-hora" '.$disabled.' onclick="hora1('.$i.')">'.$i.':30</button>';
	}

}

echo '
</div>
';




?>



<script >
	function hora(h) {
		document.getElementById('hora').value = h + ':00';

		var id_pac = document.getElementById("txtidpac").value;
		var id = document.getElementById("id").value;
		var data = document.getElementById("txtpesquisar").value;
		var medico = document.getElementById("cbmedicos").value;


		document.getElementById('data').value = data;
		document.getElementById('medico').value = medico;

		if(id_pac == ''){
			document.getElementById('txtid').value = id;
		}else{
			document.getElementById('txtid').value = id_pac;
		}




		if (id == '' && id_pac == ''){
			alert('Escolha o Paciente');
		}else{
			$("#modal").modal("show");
			document.getElementById("mensagem").style.display = "none";
		}
		
	}
</script>


<script >
	function hora1(h) {
		document.getElementById('hora').value = h + ':30';

		var id_pac = document.getElementById("txtidpac").value;
		var id = document.getElementById("id").value;
		var data = document.getElementById("txtpesquisar").value;
		var medico = document.getElementById("cbmedicos").value;


		document.getElementById('data').value = data;
		document.getElementById('medico').value = medico;

		if(id_pac == ''){
			document.getElementById('txtid').value = id;
		}else{
			document.getElementById('txtid').value = id_pac;
		}




		if (id == '' && id_pac == ''){
			alert('Escolha o Paciente');
		}else{
			$("#modal").modal("show");
			document.getElementById("mensagem").style.display = "none";
		}
		
	}
</script>

<script >
	function hora0(h) {
		document.getElementById('hora').value = h + ':15';

		var id_pac = document.getElementById("txtidpac").value;
		var id = document.getElementById("id").value;
		var data = document.getElementById("txtpesquisar").value;
		var medico = document.getElementById("cbmedicos").value;


		document.getElementById('data').value = data;
		document.getElementById('medico').value = medico;

		if(id_pac == ''){
			document.getElementById('txtid').value = id;
		}else{
			document.getElementById('txtid').value = id_pac;
		}




		if (id == '' && id_pac == ''){
			alert('Escolha o Paciente');
		}else{
			$("#modal").modal("show");
			document.getElementById("mensagem").style.display = "none";
		}
		
	}
</script>




