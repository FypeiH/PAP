<?php 

	
//Verificar se existem consultas não confirmadas que já passaram da data

$resultado_ex = $pdo->query("SELECT * from consultas where data < curDate() AND estado_pagamento != 'Sim'");

$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);


for ($i=0; $i < count($dados_ex); $i++) { 
  foreach ($dados_ex[$i] as $key => $value) {
  }

  $id = $dados_ex[$i]['id']; 

  $pdo->query("DELETE from consultas where id = '$id'");

}


 ?>


<div class="area_cards">
	<div class="row">
	
		<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center icon-warning">
								<i class="fas fa-globe"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Totalização de dados</p>
								<p class="subtitulo-card">50</p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						Total de Dados Verificados

					</div>
			</div>
		</div>


		<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center icon-warning">
								<i class="fas fa-globe"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Totalização de dados</p>
								<p class="subtitulo-card">50</p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						Total de Dados Verificados

					</div>
			</div>
		</div>


		<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center icon-warning">
								<i class="fas fa-globe"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Totalização de dados</p>
								<p class="subtitulo-card">50</p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						Total de Dados Verificados

					</div>
			</div>
		</div>

	</div>
</div>
