<?php 

require_once("conexao.php");
require_once("config.php");

$pagina = 'pacientes'; 

?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
	<title>HospSYS SIGN UP</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="CSS/signin.css">
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
		<form method="POST" action="signup/inserir.php">
			
			<div class="logo">
				<img src="img/logo.jpg" alt="HospSYS">
			</div>
			
			
			<h2 class="text-center">
				Registe-se!
			</h2>
			

			<div class="row">
            <div class="col-md-6">
              <div class="form-group">

                <label for="exampleFormControlInput1">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">NIF</label>
                <input type="text" class="form-control" id="nif" placeholder="NIF" name="nif" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label for="exampleFormControlInput1">Telefone</label>
              <input type="text" class="form-control" id="telefone" placeholder="Telefone" name="telefone" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleFormControlInput1">Email</label>
              <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-6">
            <label for="exampleFormControlSelect1">Sexo</label>


            <select class="form-control" id="sexo" name="sexo">
              <option value="Masculino">Masculino</option>
              <option value="Feminino">Feminino</option>
            </select>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleFormControlInput1">Data de Nascimento</label>
              <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>
          </div>

        </div>


        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
         <label for="exampleFormControlInput1">Password</label>
         <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="" required>
       </div>
       </div>

      
       <div class="col-md-6">
       <div class="form-group">
         <label for="exampleFormControlInput1">Confirmar Password</label>
         <input type="password" class="form-control" id="password_confirmar" placeholder="Confirmar Password" name="password_confirmar" value="" required>
       </div>
       </div>
       </div>

    <div class="form-group">
      <button type="submit" name="Salvar" id="Salvar" class="btn btn-info btn-lg btn-block">Sign In</button>
    </div>

    <div class="clearfix">
        <a href="index.php" class="float-right text-secondary">Já está Registado?</a>
      </div>
		</form>

  </div>
  
  <?php include('footers/footer.php'); ?>
  </div>
</body>
</html>


<!-- Mascaras -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="JS/mascaras.js"></script>


<!-- AJAX para inserir os dados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

   $('#Salvar').click(function(event) {



          $.ajax({

            url: pag + "inserir.php",
            method: "POST",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem){

              $('#mensagem').removeClass()

              if(mensagem == 'Registado com Sucesso!')
              {
                $('#mensagem').addClass('mensagem-sucesso')

                $('#nome').val('')
                $('#nif').val('')
                $('#cc').val('')
                $('#telefone').val('')
                $('#email').val('')
                $('#data_nascimento').val('')
                $('#estado_civil').val('')
                $('#sexo').val('')
                $('#endereco').val('')
                $('#password').val('')


              }
              else
              {
                $('#mensagem').addClass('mensagem-erro')
              }
              $('#mensagem').text(mensagem)
            },
          })
        })
 })

</script>