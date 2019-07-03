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
        <!--Inicio Progresso-->
        <div class="row">
          <div class="col-md-12">
            <h3 class="titulo-h3">Etapa 2</h3>
            <div class="progress" style="border: 1px solid #ddd;">
              <div class="progress-bar" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <!--Fim Progresso-->

        <br><br>

        <!--Inicio Form-->
        <form action="/criar-apuracao-etapa3" method="post">

          <div class="row">
            <div class="col-md-12">
              <h3 class="titulo-h3">Dados da Apuração</h3>
            </div>
          </div>

          <hr>
          <br>

         
          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" value="Enviar">
              <a href="/criar-apuracao-etapa1" class="btn btn-primary pull-left margin">Voltar</a>
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