<?php 

$pagina = 'pagamentos'; 
$dia_atual = date('Y-m-d');

?>

<style type="text/css">
  .carregando{
    color:#4683c1;
    display:none;
  }
</style>

<div class="row botao-novo">
	<div class="col-md-12">
		
    <a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
    <a href="index.php?acao=<?php echo $pagina; ?>&funcao=novo" type="button" class="btn btn-light">Novo Pagamento</a>

  </div>
</div>

<div class="row mt-4">
	<div class="col-md-3 col-sm-12">
		<div class="float-left">

      

  </div>
</div>

<?php 

  //Definir o número de itens por página

if(isset($_POST['itens-pagina']))
{
  $itens_por_pagina = $_POST['itens-pagina'];
  @$_GET['pagina'] = 0;
}
elseif(isset($_GET['itens']))
{
  $itens_por_pagina = $_GET['itens'];
}
else
{
  $itens_por_pagina = $opcao1;

}

?>

<div class="col-md-9 col-sm-12">
  <div class="float-right mr-4">

   <form id="frm" class="form-inline my-2 my-lg-0" method=POST>

     <input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

     <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">

     <input class="form-control form-control-sm mr-sm-2 " type="text" name="txtpesquisar" id="txtpesquisar" placeholder="Pesquisar Nome">
     
     <input class="form-control form-control-sm mr-sm-2 " type="date" name="dataInicial" id="dataInicial" value="<?php echo $dia_atual ?>">

     <input class="form-control form-control-sm mr-sm-2 " type="date" name="dataFinal" id="dataFinal" value="<?php echo $dia_atual ?>">

     <button class="btn btn-info btn-sm my-2 my-sm-0 " name="<?php echo $pagina; ?>" id="btn-pesquisar"><i class="fas fa-search"></i></button>

   </form>

 </div>
</div>

</div>

<div id="listar">


</div>


<!-- Modal -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Pagamento 
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<form id="form" method=POST enctype="multipart/form-data">
      		
          <div class="form-group">

            <select class="form-control" id="cargo" name="cargo">
              <option value="">Cargo</option>


              <?php 

                //Trazer todos os registos de cargos

              $res = $pdo->query("SELECT * from cargos order by nome asc");
              $dados = $res->fetchAll(PDO::FETCH_ASSOC);

              for ($i=0; $i < count($dados); $i++) { 
                foreach ($dados[$i] as $key => $value) {
                }

                $id = $dados[$i]['id']; 
                $nome = $dados[$i]['nome'];


                echo '<option value="'.$id.'">'.$nome.'</option>';



              }
              ?>
            </select>
          </div>

          <div class="form-group">

            <span class="carregando">Aguarde, a carregar...</span>
            <select class="form-control" id="funcionario" name="funcionario">
              <option value="">Funcionário</option>

            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">Valor</label>
            <input type="text" class="form-control" id="valor" placeholder="Valor" name="valor" required>
          </div>


          


          <div id="mensagem" class="col-md-12 text-center mt-3">

          </div>

        </div>
        <div class="modal-footer">

          <button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


          <button type="submit" name="Salvar" id="Salvar" class="btn btn-info">Salvar</button>


        </div>
      </form>
    </div>
  </div>
</div>


<!-- Código do botão "Nova Especialidade" -->

<?php 

if(@$_GET['funcao'] == 'novo' && @$item_paginado == '')
  {  ?>
    <script>$('#btn-novo').click();</script>
  <?php } ?>


  <!-- Código do botão "Editar" -->

  <?php 

  if(@$_GET['funcao'] == 'editar' && @$item_paginado == '')
    {  ?>
      <script>$('#btn-novo').click();</script>
    <?php } ?>


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


    <!-- Código do botão "Concluir" -->

    <?php 

    if(@$_GET['funcao'] == 'confirmar' && @$item_paginado == '')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-confirmar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmar Pagamento</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Deseja mesmo confirmar este pagamento?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-confirmar" name="btn-fechar-confirmar" data-dismiss="modal">Cancelar</button>
              <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-confirmar" name="btn-confirmar" class="btn btn-success">Confirmar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-confirmar').modal("show")</script>



    <!-- Mascaras -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script src="../JS/mascaras.js"></script>



    <!-- AJAX para inserir os dados-->

    <script type="text/javascript">

      $(document).ready(function(){

        var pag = "<?=$pagina?>";

        $('#Salvar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/inserir.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#mensagem').removeClass()

          if(mensagem == 'Registado com Sucesso!')
          {
            $('#mensagem').addClass('mensagem-sucesso')


            $('#txtpesquisar').val('')
            $('#btn-pesquisar').click();

            $('#btn-fechar').click();


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
      $('#txtpesquisar').keyup(function(){

        $('#btn-pesquisar').click();

      })


    </script>


    <!-- AJAX para editar os dados-->

    <script type="text/javascript">

      $(document).ready(function(){

        var pag = "<?=$pagina?>";

        $('#Editar').click(function(event) {
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


            $('#txtpesquisar').val('')
            $('#btn-pesquisar').click();

            $('#btn-fechar').click();


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
          $('#btn-excluir').click();
          $('#btn-fechar-excluir').click();

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


    <!-- AJAX para confirmar o pagamento-->

    <script type="text/javascript">

      $(document).ready(function(){

        var pag = "<?=$pagina?>";

        $('#btn-confirmar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/editar.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#btn-pesquisar').click();

          $('#btn-fechar-confirmar').click();

        },
      })
    })
      })

    </script>


    <!--AJAX para chamar o carregamento do input select a partir de outro input -->
    <script type="text/javascript">
      $(function(){
        $('#cargo').change(function(){
          if( $(this).val() ) {
            $('#funcionario').hide();
            $('.carregando').show();
            $.getJSON('pagamentos/listar-func.php?search=',{cargo: $(this).val(), ajax: 'true'}, function(j){
              var options = '<option value="">Funcionário</option>';  
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
              } 
              $('#funcionario').html(options).show();
              $('.carregando').hide();
            });
          } else {
            $('#funcionario').html('<option value="">– Funcionário –</option>');
          }
        });
      });
    </script>


    <!-- AJAX para pesquisar os dados pela data incial-->

    <script type="text/javascript">
      $('#dataInicial').change(function(){

        $('#btn-pesquisar').click();

      })


    </script>

     <!-- AJAX para pesquisar os dados pela data incial-->

    <script type="text/javascript">
      $('#dataFinal').change(function(){

        $('#btn-pesquisar').click();

      })


    </script>