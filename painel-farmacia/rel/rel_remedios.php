
<?php 

include('../../conexao.php');

?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>

	@page {
		margin: 0px;

	}

	.footer {
		position:absolute;
		bottom:0;
		width:100%;
		background-color: #ebebeb;
		padding:10px;
	}

	.cabecalho {    
		background-color: #ebebeb;
		padding-top:15px;
		margin-bottom:30px;
	}

	.titulo{
		margin:0;
	}

	.areaTotais{
		border : 0.5px solid #bcbcbc;
		padding: 15px;
		border-radius: 5px;
		margin-right:25px;
	}

	.areaTotal{
		border : 0.5px solid #bcbcbc;
		padding: 15px;
		border-radius: 5px;
		margin-right:25px;
		background-color: #f9f9f9;
		margin-top:2px;
	}

	.pgto{
		margin:1px;
	}



</style>


<div class="cabecalho">
	
	<div class="row">
		<div class="col-sm-4">	
			<img src="../../img/logohorizontal.png" width="250px">
		</div>
		<div class="col-sm-6">	
			<h3 class="titulo"><b>HospSYS - Sistemas Hospitalares</b></h3>
			<h6 class="titulo">Rua NÃOSEIQUAL Nº 12, Alverca 2615-263</h6>
		</div>
	</div>
	

</div>

<div class="container">


	<div class="row">
		<div class="col-sm-12">	
			<big><big> RELATÓRIO DE REMÉDIOS  </big> </big> 
		</div>

	</div>

	<hr>




	<br><br>

	<?php

	$res = $pdo->query("SELECT * from remedios order by nome asc");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);



	?>


	<table class="table">
		<tr bgcolor="#f9f9f9">
			<td style="font-size:12px"> <b>Tipo</b> </td>
			<td style="font-size:12px"> <b>Movimento</b> </td>
			<td style="font-size:12px"> <b> Valor</b> </td>
			<td style="font-size:12px"> <b> Funcionário</b> </td>

			<td style="font-size:12px"> <b> Data</b> </td>

		</tr>


		<?php 

		for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id']; 
			$nome = $dados[$i]['nome'];
			$descricao = $dados[$i]['descricao'];
			$estoque = $dados[$i]['estoque'];		

			?>

			<tr>
				<td style="font-size:12px"> <?php echo $nome; ?> </td>
				<td style="font-size:12px"> <?php echo $descricao; ?> </td>
				<td style="font-size:12px"> R$ <?php echo $estoque; ?> </td>				
			</tr>

		<?php }  ?>
	</table>



<hr>


<hr>

<?php
if($tipo == 'Todas'){

	?>

	<div class="row">
		<div class="col-sm-12">	
			<p style="font-size:12px">
				<b>Quantidade de Entradas:</b>  <?php echo $quant_entradas; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Quantidade de Saídas:</b>  <?php echo $quant_saidas; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;




			</p>
		</div>
	</div>

	<div class="row">

		<div class="col-sm-7">	
			<p style="font-size:12px">
				<b>Valor das Entradas:</b> <font color="green"> R$ <?php echo $total_entradas; ?>,00 </font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Valor das Saídas:</b><font color="red"> R$ <?php echo $total_saidas; ?>,00 </font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;




			</p>
		</div>
		<div class="col-sm-3">	
			<p style="font-size:12px" align="right">
				<b>Saldo Total:</b>
				<?php 
				$saldo = $total_entradas - $total_saidas;
				if($saldo >= 0){
					?>
					<font color="green">R$ <?php echo $saldo ?>,00 </font>
					<?php 
				}else{
					?>
					<font color="red">R$ <?php echo $saldo ?>,00 </font> 
					<?php 
				}

				?>





			</p>
		</div>

	</div>

<?php }else{

	?>

	<div class="row">
		<div class="col-sm-8">	
			<small><b> Quantidade de Movimentações:</b> <?php echo $quant; ?> </small>
		</div>
		<div class="col-sm-4">	
			<small><b> Valor Total:</b> R$<?php echo $total_mov; ?>,00 </small>
		</div>

	</div>

	<?php
}

?>






</div>


<div class="footer">
	<p style="font-size:12px" align="center">Desenvolvido por Hugo Vasconcelos - Q-Cursos Networks</p> 
</div>


