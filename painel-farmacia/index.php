<?php

//Verificações para o Login
require_once("../conexao.php");
require_once("../config.php");

@session_start();

if(!isset($_SESSION['nome_utilizador']) || $_SESSION['nivel_utilizador'] != 'Farmacêutico')
{
	header("location:../index.php");
}

$id_utilizador = $_SESSION['id_utilizador'];

//Buscar o nome da foto de perfil
$resultado_foto = $pdo->query("SELECT * from utilizadores where id = $id_utilizador");
$dados_foto = $resultado_foto->fetchAll(PDO::FETCH_ASSOC);
$foto = $dados_foto[0]['foto'];


//Fazer atualização do nome na nav
$resultado_nome = $pdo->query("SELECT * from utilizadores where id = $id_utilizador");
$dados_nome = $resultado_nome->fetchAll(PDO::FETCH_ASSOC);
$nome_utilizador = $dados_nome[0]['nome'];


$notificacoes=3;

//Variáveis dos Menus

$item1 = 'home';
$item2 = 'remedios';
$item3 = 'entradas';
$item4 = 'saidas';
$item5 = 'fornecedores';
$item6 = 'prescricao';
$item7 = 'editar-perfil';
$item8 = 'nivel';
$item9 = 'rel';

//Verificar qual é o Menu selecionado e ativá-lo

if(@$_GET['acao'] == $item1){ 
	$item1ativo = 'active';
}elseif (@$_GET['acao'] == $item2) {
	$item2ativo = 'active';
}elseif (@$_GET['acao'] == $item3) {
	$item3ativo = 'active';
}elseif (@$_GET['acao'] == $item4) {
	$item4ativo = 'active';
}elseif (@$_GET['acao'] == $item5) {
	$item5ativo = 'active';
}elseif (@$_GET['acao'] == $item6) {
	$item6ativo = 'active';
}elseif (@$_GET['acao'] == $item8) {
	$item8ativo = 'active';
}elseif (@$_GET['acao'] == $item9) {
	$item9ativo = 'active';
}else{
	$item1ativo = 'active';
} 



?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
	<title>Painel Farmácia</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="../CSS/painel1.css">
	<link rel="stylesheet" href="../CSS/footer.css">

	<!--Referência para o Favicon -->
	<link rel="shortcut icon" href="../img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="../img/favicon/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>

	<div style="box-shadow:0px 0px 8px rgba(0, 0, 0, 0.3);">
		<nav class="navbar navbar-light bg-light">

			<div class="col-md-12">

				<img class="float-left" src="../img/logohorizontal.png">


				<div class="float-right">
					<?php echo'<img style="height: 50px; width: 50px; border-radius: 6px;" src="../img/fotos-perfil/'.$foto.'">';?>
				</div>


				<li class="float-right nav-item dropdown">		

					<a class="float-right nav-link dropdown-toggle mt-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Farmacêutico - <?php echo $nome_utilizador; ?>
					</a>

					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<li><a class="dropdown-item" href="index.php?acao=<?php echo $item7 ?>">Editar Perfil</a></li>
						<li><a class="dropdown-item" href="../logout.php">Logout</a></li>
					</ul>
				</li>
			</div>

		</li>
	</div>

</nav>
</div>
<div class="main-container">
	<div class="container-fluid mt-4">
		
		<div class="row">
			<div class="col-md-3 col-sm-12 mb-4">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

					<a class="nav-link <?php echo $item1ativo ?>" id="v-pills-home-tab" href="index.php?acao=<?php echo $item1 ?>" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-home mr-1"></i>Home</a>

					<a class="nav-link <?php echo $item2ativo ?>" id="link-medicos" href="index.php?acao=<?php echo $item2 ?>" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-user-md mr-1"></i>Registo de Remédios</a>

					<a class="nav-link <?php echo $item3ativo ?>" id="v-pills-messages-tab" href="index.php?acao=<?php echo $item3 ?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-user mr-1"></i>Entrada de Remédios</a>

					<a class="nav-link <?php echo $item4ativo ?>" id="v-pills-messages-tab" href="index.php?acao=<?php echo $item4 ?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-user mr-1"></i>Saída de Remédios</a>

					<a class="nav-link <?php echo $item5ativo ?>" id="v-pills-messages-tab" href="index.php?acao=<?php echo $item5 ?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-user mr-1"></i>Fornecedores</a>

					<a class="disabled nav-link <?php echo $item6ativo ?>" id="v-pills-messages-tab" href="index.php?acao=<?php echo $item6 ?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-user mr-1"></i>Prescrições</a>

					<a class="nav-link <?php echo $item8ativo ?>" id="v-pills-messages-tab" href="index.php?acao=<?php echo $item8 ?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-user mr-1"></i>Stock Baixo</a>

					<a class="nav-link <?php echo $item9ativo ?>" id="v-pills-messages-tab" href="rel/rel_remedios_class.php?acao=<?php echo $item9?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-user mr-1"></i>Relatório de Remédios</a>
					
				</div>
			</div>

			<div class="col-md-9 col-sm-12">
				<div class="tab-content" id="v-pills-tabContent">


					<div class="tab-pane fade show active" role="tabpanel">
						<?php if(@$_GET['acao'] == $item1){ 
							include_once($item1.".php");
						}elseif (@$_GET['acao'] == $item2) {
							include_once($item2.".php");
						}elseif (@$_GET['acao'] == $item3) {
							include_once($item3.".php");
						}elseif (@$_GET['acao'] == $item4) {
							include_once($item4.".php");
						}elseif (@$_GET['acao'] == $item5) {
							include_once($item5.".php");
						}elseif (@$_GET['acao'] == $item6) {
							include_once($item6.".php");
						}elseif (@$_GET['acao'] == $item7) {
							include_once($item7.".php");
						}elseif (@$_GET['acao'] == $item8) {
							include_once($item8.".php");
						}else{
							include_once($item1.".php");
						} 

						?>
					</div>


				</div>
			</div>
		</div>

	</div>

	<?php 

		$res = $pdo->query("SELECT * from remedios where estoque <= '$nivel_stock' order by estoque asc");
  
  		$dados = $res->fetchAll(PDO::FETCH_ASSOC);

  		$nivel_baixo = count($dados);

  		if($nivel_baixo > 0)
  		{
	?>

	<a href="index.php?acao=<?php echo $item8 ?>">
		<div class="col-md-2 alert-danger alertas">
			<span>Stock Baixo!</span>
		</div>
	</a>

<?php } ?>

	<?php include('../footers/footer.php'); ?>
</div>

</body>
</html>



<?php 


/*

//EXECUTAR UM LINK HREF COM SCRIPT

	if(isset($_GET['btnpesquisarMedicos'])){ ?>

		<script type="text/javascript">
			
			$('#link-medicos').click();

		</script>

		<?php } */ ?>