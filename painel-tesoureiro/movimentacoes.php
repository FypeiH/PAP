<?php 

$pagina = 'movimentacoes'; 
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


  </div>
</div>

<div class="row mt-4">
	<div class="col-md-3 col-sm-12">
		<div class="float-left">



    </div>
  </div>


  <div class="col-md-9 col-sm-12">
    <div class="float-right mr-4">

     <form id="frm" class="form-inline my-2 my-lg-0" method=POST>

       <input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

       <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">

       <select class="form-control form-control-sm" id="txtpesquisar" name="txtpesquisar">

          <option value="">Entradas e Saída</option>
          <option value="Entrada">Entradas</option>
          <option value="Saída">Saídas</option>
      
       </select>     
       <input class="form-control form-control-sm ml-4 mr-sm-2 " type="date" name="dataInicial" id="dataInicial" value="<?php echo $dia_atual ?>">

       <input class="form-control form-control-sm mr-sm-2 " type="date" name="dataFinal" id="dataFinal" value="<?php echo $dia_atual ?>">

       <button class="btn btn-info btn-sm my-2 my-sm-0 " name="<?php echo $pagina; ?>" id="btn-pesquisar"><i class="fas fa-search"></i></button>

     </form>

   </div>
 </div>

</div>

<div id="listar">


</div>


   

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