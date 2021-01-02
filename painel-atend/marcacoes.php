<?php 

$pagina = 'marcacoes'; 
$dia_atual = date('Y-m-d');


  //Recuperar o ID do Paciente

if(isset($_GET['id']))
{
  $id_paciente = $_GET['id'];
  $nif_paciente = $_GET['nif'];
}


?>

<input type="hidden" id="txtidpac" name="txtidpac" value="<?php echo @$id_paciente; ?>">


<div class="row mt-4 mb-3">
	<div class="col-md-6 col-sm-12">
    <form id="frm" class="form-inline my-2 my-lg-0" method=POST>


      <input class="form-control form-control-sm mr-sm-2 " type="search" placeholder="NIF do Paciente" aria-label="Search" name="txtpesquisar-paciente" id="txtpesquisar-paciente" value="<?php echo @$nif_paciente ?>">
      <button class="btn btn-info btn-sm my-2 my-sm-0 " name="btn-pesquisar-paciente" id="btn-pesquisar-paciente"><i class="fas fa-search"></i></button>
    </form>
  </div>


  <div class="col-md-6 col-sm-12">
    <div class="float-right mr-4">

     <form id="frm" class="form-inline my-2 my-lg-0" method=POST>

       <input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

       <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">


       <label class="mr-1 text-light" for="exampleFormControlSelect1"><small>Médicos</small></label>
       <select class="form-control form-control-sm mr-2" id="cbmedicos" name="cbmedicos">


        <?php 
        
                //Trazer todos os registo de médicos

        $res = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' order by nome asc");
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);

        for ($i=0; $i < count($dados); $i++) { 
          foreach ($dados[$i] as $key => $value) {
          }

          $id = $dados[$i]['id']; 
          $nome = $dados[$i]['nome'];


          echo '<option value="'.$id.'">'.$nome.'</option>';

        } ?>


      </select>
      <input class="form-control form-control-sm mr-sm-2 " type="date" name="txtpesquisar" id="txtpesquisar" value="<?php echo $dia_atual ?>">
      <button class="btn btn-info btn-sm my-2 my-sm-0 " name="btn-pesquisar" id="btn-pesquisar"><i class="fas fa-search"></i></button>

    </form>

  </div>
</div>

</div>


<div id="listar-pacientes">



</div>

<div id="listar" class="mt-4">



</div>



<!-- Modal -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">

          Nova Marcação

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method=POST>

          <div class="form-group">

            <input type="hidden" id="id"  name="id"  required>
          <input type="hidden" id="txtid"  name="txtid" required>
          <input type="hidden" id="medico"  name="medico" required>
          <input type="hidden" id="data"  name="data" required>
          <input type="hidden" id="hora"  name="hora" required>

            <div class="form-group">
             <label for="exampleFormControlSelect1">Atendimentos</label>
             <select class="form-control" id="atendimentos" name="atendimentos">



              <?php 


                //Trazer todos os registo de especialidades

              $res = $pdo->query("SELECT * from atendimentos order by descricao asc");
              $dados = $res->fetchAll(PDO::FETCH_ASSOC);

              for ($i=0; $i < count($dados); $i++) { 
                foreach ($dados[$i] as $key => $value) {
                }

                $id = $dados[$i]['id']; 
                $descricao = $dados[$i]['descricao'];
                $valor = $dados[$i]['valor']; 

                if($nome_espec != $nome){

                  echo '<option value="'.$id.'">'.$descricao.' - '.$valor.'€</option>';

                }

              } ?>
            </select>
          </div>



          <div id="mensagem" class="col-md-12 text-center mt-3">

          </div>

        </div>
        <div class="modal-footer">

          <button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


          <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-info">Salvar</button>


        </div>
      </form>
    </div>
  </div>
</div>
</div>


<!-- Mascaras -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script>
  $(document).ready(function(){
    $('#txtpesquisar-paciente').mask('000.000.000');
  })  
</script>



<!-- AJAX para inserir os dados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $('#btn-salvar').click(function(event) {
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
           
            document.getElementById('mensagem').style.display = "block";

            $('#mensagem').addClass('mensagem-sucesso')


            $('#btn-fechar').click();
            document.getElementById('listar-pacientes').style.display = "none";
            document.getElementById('txtpesquisar-paciente').value = "";
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


<!-- AJAX para filtro direto dos dados pesquisados (Data)-->

<script type="text/javascript">
  $('#txtpesquisar').change(function(){

    $('#btn-pesquisar').click();

  })


</script>


<!-- AJAX para filtro direto dos dados pesquisados (Combobox)-->

<script type="text/javascript">
  $('#cbmedicos').change(function(){

    $('#btn-pesquisar').click();

  })


</script>


<!-- AJAX para listar os dados pesquisados do Paciente-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $('#btn-pesquisar-paciente').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/listar-pacientes.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "html",
        success: function(result){

          $('#listar-pacientes').html(result)

        },
      })

    })

  })

</script>



<!-- AJAX para filtro direto dos dados pesquisados (Pacientes)-->

<script type="text/javascript">
  $('#txtpesquisar-paciente').keyup(function(){
    document.getElementById("listar-pacientes").style.display = "block";
    $('#btn-pesquisar-paciente').click();

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