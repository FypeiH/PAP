<?php 

$pagina = 'utilizadores'; 

?>



<div class="row mt-4">
	<div class="col-md-6 col-sm-12">
		<div class="float-left">

      <form method = POST>
       <select onChange="submit();" class="form-control-sm" id="exampleFormControlSelect1" name="itens-pagina">

        <?php 

        if(isset($_POST['itens-pagina']))
        {
          $item_paginado = $_POST['itens-pagina'];
        }
        elseif(isset($_GET['itens'])){
          $item_paginado = $_GET['itens'];
        }

        ?>

        <option value="<?php echo @$item_paginado ?>"><?php echo @$item_paginado ?> Registos</option>

        <?php if(@$item_paginado != $opcao1) 
        { ?>
          <option value="<?php echo $opcao1; ?>"><?php echo $opcao1; ?> Registos</option>

        <?php }?>

        <?php if(@$item_paginado != $opcao2) 
        { ?>
          <option value="<?php echo $opcao2; ?>"><?php echo $opcao2; ?> Registos</option>

        <?php }?>

        <?php if(@$item_paginado != $opcao3) 
        { ?>
          <option value="<?php echo $opcao3; ?>"><?php echo $opcao3; ?> Registos</option>

        <?php }?>

      </select>
    </form>


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

<div class="col-md-6 col-sm-12">
  <div class="float-right mr-4">

   <form id="frm" class="form-inline my-2 my-lg-0" method=POST>

     <input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

     <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">
     
     <input class="form-control form-control-sm mr-sm-2 " type="search" placeholder="Pesquisar Nome" aria-label="Search" name="txtpesquisar" id="txtpesquisar">
     <button class="btn btn-info btn-sm my-2 my-sm-0 " name="<?php echo $pagina; ?>" id="btn-pesquisar"><i class="fas fa-search"></i></button>

   </form>

 </div>
</div>

</div>

<div id="listar">


</div>


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
              <h5 class="modal-title">Desativar Conta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Deseja mesmo desativar esta conta?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-excluir" name="btn-fechar-excluir" data-dismiss="modal">Cancelar</button>
              <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-excluir" name="btn-excluir" class="btn btn-danger">Desativar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-excluir').modal("show")</script>


    <!-- Código do botão "Ativar" -->

    <?php 

    if(@$_GET['funcao'] == 'ativar' && @$item_paginado == '')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-ativar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ativar Conta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Deseja mesmo ativar esta conta?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-ativar" name="btn-fechar-ativar" data-dismiss="modal">Cancelar</button>
              <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-ativar" name="btn-ativar" class="btn btn-success">Ativar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-ativar').modal("show")</script>


            <!-- Código do botão "Mudar Nível" -->

    <?php 

    if(@$_GET['funcao'] == 'mudar_nivel' && @$item_paginado == '')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-nivel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Mudar o Nível da Conta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method=POST>
              <select class="form-control" id="" name="nivel">
                <?php 

                  $resultado = $pdo->query("SELECT * from utilizadores where id = '$id'");

                  $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

                  $nivel = $dados[0]['nivel']; 

                  echo ' <option value="'.$nivel.'">'.$nivel.'</option>';

                  if($nivel != 'Admin'){echo '<option value="Admin">Admin</option>';}
                  if($nivel != 'Médico'){echo '<option value="Médico">Médico</option>';}
                  if($nivel != 'Farmacêutico'){echo '<option value="Farmacêutico">Farmacêutico</option>';}
                  if($nivel != 'Recepcionista'){echo '<option value="Recepcionista">Recepcionista</option>';}
                  if($nivel != 'Tesoureiro'){echo '<option value="Tesoureiro">Tesoureiro</option>';}
          
            ?>
              </select>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-mudar" name="btn-fechar-mudar" data-dismiss="modal">Cancelar</button>
              <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-mudar" name="btn-mudar" class="btn btn-info">Salvar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-nivel').modal("show")</script>



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

            $('#nome').val('')
            $('#cedula').val('')
            $('#nif').val('')
            $('#telefone').val('')
            $('#email').val('')

            $('#txtpesquisar').val('')
            $('#btn-pesquisar').click();

            //$('#btn-fechar').click();


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

          $('#txtpesquisar').val('')
          $('#btn-pesquisar').click();

          $('#btn-fechar-excluir').click();

        },
      })
    })
      })

    </script>

    <!-- AJAX para ativar a conta-->

    <script type="text/javascript">

      $(document).ready(function(){

        var pag = "<?=$pagina?>";

        $('#btn-ativar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/ativar.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#txtpesquisar').val('')
          $('#btn-pesquisar').click();

          $('#btn-fechar-ativar').click();

        },
      })
    })
      })

    </script>

    <!-- AJAX para mudar o nivel do utilizador-->

    <script type="text/javascript">

      $(document).ready(function(){

        var pag = "<?=$pagina?>";

        $('#btn-mudar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/mudar-nivel.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#txtpesquisar').val('')
          $('#btn-pesquisar').click();

          $('#btn-fechar-mudar').click();

        },
      })
    })
      })

    </script>