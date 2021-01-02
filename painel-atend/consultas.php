<?php 

$pagina = 'consultas'; 
$dia_atual = date('Y-m-d');

?>

<div class="row botao-novo">
	<div class="col-md-12">
		

  </div>
</div>

<div class="row mt-4">
	<div class="col-md-6 col-sm-12">
		<div class="float-left">


  </div>
</div>


<div class="col-md-6 col-sm-12">
  <div class="float-right mr-4">

   <form id="frm" class="form-inline my-2 my-lg-0" method=POST>

     <input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

     <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">
     
     <input class="form-control form-control-sm mr-sm-2 " type="date" name="txtpesquisar" id="txtpesquisar" value="<?php echo $dia_atual ?>">
     <button class="btn btn-info btn-sm my-2 my-sm-0 " name="btn-pesquisar" id="btn-pesquisar"><i class="fas fa-search"></i></button>

   </form>

 </div>
</div>

</div>

<div id="listar">


</div>

<!-- Código do botão "Editar" -->

<?php 

if(@$_GET['funcao'] == 'editar')
{  
  $id_con = $_GET['id'];


  //Buscar o ID do médico

  $res_medico = $pdo->query("SELECT * from consultas where id = '$id_con'");
  $dados_medico = $res_medico->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_medico);


  if($linhas > 0)
  {

    $id_medico = $dados_medico[0]['medico'];
    $data = $dados_medico[0]['data'];
    $hora = $dados_medico[0]['hora']; 

  }

  $res_med = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' and id = '$id_medico'");
  $dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);

  for ($i=0; $i < count($dados_med); $i++) { 
    foreach ($dados_med[$i] as $key => $value) {
    }

    $id_med = $dados_med[$i]['id']; 
    $nome_med = $dados_med[$i]['nome'];

  }

  ?>

  <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Consulta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST">

            <input type="hidden" id="id" name="id" value="<?php echo @$id_con ?>">

            <div class="form-group">
             <label for="exampleFormControlSelect1">Médico</label>
             <select class="form-control" id="" name="medico">



              <?php 

                //Se exister a edição dos dados, trazer como primeiro registo a especialidade do médico




              echo '<option value="'.$id_med.'">'.$nome_med.'</option>';


                //Trazer todos os registo de especialidades

              $res = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' order by nome asc");
              $dados = $res->fetchAll(PDO::FETCH_ASSOC);

              for ($i=0; $i < count($dados); $i++) { 
                foreach ($dados[$i] as $key => $value) {
                }

                $id = $dados[$i]['id']; 
                $nome = $dados[$i]['nome'];

                if($nome_med != $nome){

                  echo '<option value="'.$id.'">'.$nome.'</option>';

                }

              } ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <input class="form-control form-control-sm mr-sm-2 " type="date" name="data" id="data" value="<?php echo $data ?>">
            </div>
            <div class="col-md-6">
              <input class="form-control form-control-sm mr-sm-2 " type="time" name="hora" id="hora" value="<?php echo $hora ?>">
            </div>
          </div>

          <div id="mensagem" class="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btn-fechar-editar" name="btn-fechar-editar" data-dismiss="modal">Cancelar</button>

          <input type="hidden" id="id" name="id" value="<?php echo @$id_con ?>">
          <button type="button" id="btn-editar" name="btn-editar" class="btn btn-info">Editar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php } ?>
<script>$('#modal-editar').modal("show")</script>



<!-- Código do botão "Excluir" -->

<?php 

if(@$_GET['funcao'] == 'excluir' && @$item_paginado == '')
{  
  $id = $_GET['id'];
  ?>

  <div class="modal" id="modal-excluir" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Excluir Registo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Deseja mesmo excluir este registo?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btn-fechar-excluir" name="btn-fechar-excluir" data-dismiss="modal">Cancelar</button>
          <form method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
            <button type="button" id="btn-excluir" name="btn-excluir" class="btn btn-danger">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php } ?>


<script>$('#modal-excluir').modal("show")</script>



<!-- Mascaras -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="../JS/mascaras.js"></script>


<!-- AJAX para listar os dados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $.ajax({
      url: pag + "/listar.php",
      method: "POST",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){

        $('#listar').html(result)

      },
    })

  })

</script>


<!-- AJAX para listar os dados pesquisados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $('#btn-pesquisar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/listar.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "html",
        success: function(result){

          $('#listar').html(result)

        },
      })

    })

  })

</script>


<!-- AJAX para filtro direto dos dados pesquisados-->

<script type="text/javascript">
  $('#txtpesquisar').change(function(){

    $('#btn-pesquisar').click();

  })


</script>



<!-- AJAX para excluir os dados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $('#btn-excluir').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/excluir.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#btn-pesquisar').click();

          $('#btn-fechar-excluir').click();

        },
      })
    })
  })

</script>

<!-- AJAX para editar os dados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $('#btn-editar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/editar.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#mensagem').removeClass()

          if(mensagem == 'Editado com Sucesso!')
          {
            $('#mensagem').addClass('mensagem-sucesso')

            $('#btn-fechar-editar').click();
            $('#btn-pesquisar').click();
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