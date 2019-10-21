<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ocorrência Agressor - Lista de Documentos</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ocorrência Agressor - Lista de Documentos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <!--Row-->
        <div class="row">
          <div class="col-md-12">
            <a href="/ocorrencia-agressor-enviar-arquivo-cadastrar/" class="btn btn-success">Novo Documento</a>
          </div>          
        </div>
        <!--Fim Row-->

        <br>

        <!--Tabela-->
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Arquivo</th>
            <th>Tipo</th>
            <th>Opções</th>
          </tr>
          
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <a href="" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
              <a href="" class="btn btn-success"><i class="fa fa-refresh"></i></a>
            </td>
          </tr>

        </table>
        <!--Fim Tabela-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->