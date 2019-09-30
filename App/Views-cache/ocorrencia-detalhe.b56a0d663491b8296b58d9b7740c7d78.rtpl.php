<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Detalhes</h3>

        <!--<div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>-->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!--Inicio Row-->
        <div class="row">
          <!--Detalhes-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>N° da Ocorrência: </strong>251</p>
            <p class="sem-espacamento"><strong>Data: </strong>15/05/2013</p>
            <p class="sem-espacamento"><strong>Status: </strong>Aberta</p>
          </div>
          <!--Fim Detalhes-->
        </div>
        <!--Fim Row-->
        
        <br>
        <hr>
        <br>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            <!--Aparecer para todos os status-->
            <a href="#" class="btn btn-app"><i class="fa fa-user"></i>Vítima</a>

            <!--Aparecer para todos os status-->
            <a href="#" class="btn btn-app"><i class="fa fa-user"></i>Agressor</a>

            <!--Aparecer para todos os status-->
            <a href="#" class="btn btn-app"><i class="fa fa-list-alt"></i>Detalhes</a>

            <!--Aparecer para todos os status-->
            <a href="/ocorrencia-relatorio" class="btn btn-app"><i class="fa fa-file-text-o"></i>Relatório</a>

            <!--Aparecer para todos os status-->
            <a href="/ocorrencia-arquivos" class="btn btn-app"><i class="fa fa-folder"></i>Arquivos</a>

            <!--Aparecer se o status for aberta, reaberta-->
            <a href="/ocorrencia-solicitacao" class="btn btn-app"><i class="fa fa-envelope"></i>Solicitação</a>
            
            <!--Aparecer se o status for aberta, reaberta-->
            <a href="#" class="btn btn-app"><i class="fa fa-inbox"></i>Arquivar</a>
            <!--Aparecer quando estiver arquivada a ocorrencia-->
            <!--<a href="#" class="btn btn-app"><i class="fa fa-inbox"></i>Desarquivar</a>-->

            <!--Aparecer se o status for aberta, reaberta e arquivada-->
            <a href="#" class="btn btn-app"><i class="fa fa-archive"></i>Encerrar</a>
          </div>
        </div>
        <!--Fim Row-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->