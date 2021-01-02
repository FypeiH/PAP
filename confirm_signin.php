<?php 

require_once("conexao.php");
require_once("config.php");

?>



<!DOCTYPE html>
<html lang="pt-pt">
<head>
	<title>HospSYS</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="CSS/login.css">
	<link rel="stylesheet" href="CSS/footer.css">

	<!--Referência para o Favicon -->
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


	<meta http-equiv="refresh" content="2; URL='index.php'"/>

</head>
<body>
	<div class="main-container">

	<div class="login-form">
		<form> 
			
			<div class="logo">
				<img src="img/logo.jpg" alt="HospSYS">
			</div>
			
			<h2 class="text-center">
				Registado com Sucesso!
			</h2>
			
			<div class="text-center">
				Redirecionando para o Login...
			</div>
			

		</form>

	</div>

	<?php include('footers/footer.php'); ?>
  </div>
</body>
</html>