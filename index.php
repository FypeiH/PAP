<?php 

require_once("config.php");
include 'includes/install.php';
require_once("conexao.php");

?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
	<title>HospSYS LOGIN</title>

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

</head>
<body>
	<div class="main-container">
	<div class="login-form">
		<form action="autenticar.php" method="POST">
			
			<div class="logo">
				<img src="img/logo.jpg" alt="HospSYS">
			</div>
			
			
			<h2 class="text-center">
				Entre no Sistema
			</h2>
			

			<div class="form-group">
				<input class="form-control" type="email" name="utilizador" placeholder="Email" required>
			</div>

			<div class="form-group">
				<input class="form-control" type="password" name="pass" placeholder="Password" required>
			</div>

			<div class="form-group">
				<button class="btn btn-info btn-lg btn-block" type="submit" name="btn-login">Login</button>
			</div>

			<div class="clearfix">
				<label class="float-left checkbox-inline">
					<input type="checkbox">
					Lembrar-me
				</label>
				<a data-toggle="modal" data-target="#modal-pass" class="float-right">Recuperar Palavra-Passe</a>
			</div>
			<div class="clearfix">
				<a href="signup.php" class="float-right text-secondary">Registe-se!</a>
			</div>

		</form>

	</div>

	<?php include('footers/footer.php'); ?>
	</div>
</body>
</html>



<!-- Modal Recuperar Palavra-Passe -->

<div class="modal fade" id="modal-pass" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-dark">Recuperar Palavra-Passe</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method=POST>
				<div class="modal-body">
					<div class="form-group">
						<label class="text-dark" for="exampleInputEmail1">Email</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email-recuperar" placeholder="Digite o seu Email">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button name="recuperar-pass" type="submit" class="btn btn-info">Recuperar</button>
				</div>
			</form>
		</div>
	</div>
</div>



<?php 

if(isset($_POST['recuperar-pass']))
{
	$email_utilizador = $_POST['email-recuperar'];

	$resultado = $pdo->prepare("SELECT * from utilizadores where email = :utilizador");

	$resultado->bindValue(":utilizador", $email_utilizador);
	$resultado->execute();

	$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados);


	if($linhas > 0)
	{
		$nome_uti = $dados[0]['nome'];
		$pass_uti = $dados[0]['pass_original'];
		$nivel_uti = $dados[0]['nivel'];
	}
	else
	{
		echo "<script language='javascript'>window.alert('Este email não está registado!'); </script>";
	}

	//Código de Envio do Email

	$to = $email_utilizador;
	$subject = 'Recuperação de Palavra-Passe HospSYS';

	$message = "

	Olá $nome_uti!! 
	<br><br> A sua palavra-passe é <b>$pass_uti </b>

	<br><br> Ir Para o Sistema -> <a href='$url_sistema' target='_blank'> Clique Aqui </a>
	";

	$remetente = $email_adm;
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
	$headers .= "From: " .$remetente;
	mail($to, $subject, $message, $headers); //Só funciona quando o sistema estiver hospedado


	echo "<script language='javascript'>window.alert('A sua palavra-passe foi enviada para o seu email, verifique no spam ou lixo eletrónico!'); </script>";

	echo "<script language='javascript'>window.location='index.php'; </script>";
}

?>