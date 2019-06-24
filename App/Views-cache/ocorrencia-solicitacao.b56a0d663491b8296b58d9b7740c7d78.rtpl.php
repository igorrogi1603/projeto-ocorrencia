<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Solicitações da Ocorrência</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Solicitações da Ocorrência</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        
        <!--Arquivos-->

        <!--Row-->
        <div class="row">
          <div class="col-md-12">
            <a href="#" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Nova Solicitação</a>
          </div>
        </div>
        <!--Fim Row-->

        <br>

        <!--Tabela-->
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Setor</th>
            <th>Date</th>
            <th>Status</th>
            <th>Opções</th>
          </tr>
          <tr>
            <td>183</td>
            <td>John Doe</td>
            <td>Pediatra</td>
            <td><span class="badge bg-light-blue">Aguardando</span></td>
            <td>11-7-2014</td>
            <td>
              <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
            </td>
          </tr>
          <tr>
            <td>219</td>
            <td>Alexander Pierce</td>
            <td>Psicologa</td>
            <td><span class="badge bg-green">Respondida</span></td>
            <td>11-7-2014</td>
            <td>
              <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
            </td>
          </tr>
        </table>
        <!--Fim Tabela-->
        <!--Fim Arquivos-->

      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->