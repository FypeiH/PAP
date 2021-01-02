<?php 

require_once("../conexao.php");
require_once("../config.php");

?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
	<title>HospSYS LOGIN</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="../CSS/signin.css">
	<link rel="stylesheet" href="../CSS/painel.css">
	<link rel="stylesheet" href="../CSS/footer.css">

	<!--Referência para o Favicon -->
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
	<div class="main-container">
	<div class="login-form">
		<form>

			<div class="logo">
				<img src="../img/logo.jpg" alt="HospSYS">
			</div>
			
			
			<h2 class="text-center">
				Escolha o Painel
			</h2>

			<div class="area_cards text-dark">
				<div class="row">

					<div class="col-sm-12 col-lg-6 col-md-12 col-sm-12 mb-4">
						<div class="card card-stats">
							<div class="card-body ">
								<div class="row">
									<div class="col-5 col-md-4">
										<div class="icone-card text-center icon-warning">
											<i class="fas fa-user-tie"></i>
										</div>
									</div>
									<div class="col-7 col-md-8">
										<div class="number">
											<h2 class="titulo-card">Farmacêutico</h2>
										</div>
									</div>
								</div>
							</div>

							<div class="card-footer rodape-card">
								<a href="../painel-farmacia/index.php" class="btn btn-info btn-lg btn-block text-decoration-none">Aceder ao Painel Profissional</a>

							</div>
						</div>
					</div>


					<div class="col-sm-12 col-lg-6 col-md-12 col-sm-12 mb-4">
						<div class="card card-stats">
							<div class="card-body ">
								<div class="row">
									<div class="col-5 col-md-4">
										<div class="icone-card text-center icon-warning">
											<i class="fas fa-user"></i>
										</div>
									</div>
									<div class="col-7 col-md-8">
										<div class="number">
											<h2 class="titulo-card">Paciente</h2>
										</div>
									</div>
								</div>
							</div>

							<div class="card-footer rodape-card">
								<a href="../painel-paciente/index.php" class="btn btn-info btn-lg btn-block text-decoration-none">Aceder ao Painel do Paciente</a>

							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
			<?php include('../footers/footer.php'); ?>
	</body>
	</html>