<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Criar Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Criar Apuração</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        
        <div class="row">
          <div class="col-md-12">
            <h3 class="titulo-h3">Dados da Apuração</h3>
          </div>
        </div>

        <hr>
        <br>

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Deve marcar quantas vítimas estão envolvidas e se pertencem a mesma família.<br>
          Caso forem da mesma família na próxima etapa o endereço deve ser preenchido iguais para as duas vítimas.
        </div>

        <button class="btn btn-default btn-block" onclick="criarVitima()">Adicionar Vítima</button>

        <!--Inicio Form-->
        <form action="/criar-apuracao-etapa2" method="post">

          <div id="imprimir-vitima">
            
          </div>

          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" value="Próximo">
            </div>            
          </div>
          <!--Fim Row-->
        </form>
        <!--Fim Form-->

      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

function criarVitima(){
  
  //criar um for percorrendo uns 100 numeros 
  //esse for vai percorrer um id ex: div1 div2 div3
  //quando a div que ele percorrer existir ele continua 
  //quando ele achar um numero que ainda nao estiver no html 
  //entao sera a proxima div a ser criada

  var cont;

  for (cont = 1; cont <=100; cont++) {
    if (document.getElementById('div-vitima'+cont) == null){
      alert('nao achei dummy');
      alert('div-vitima'+cont);
      break;
    } else {
      alert('achei dammy');
    }
  }

}

</script>