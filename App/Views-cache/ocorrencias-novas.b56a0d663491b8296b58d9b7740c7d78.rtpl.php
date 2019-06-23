<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Novas Ocorrências</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Novas Ocorrências</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Ultimas ocorrências criadas</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Vítima</th>
              <th>CPF da Vítima</th>
              <th>Agressor</th>
              <th>Data de Criação</th>
              <th>Opções</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>251</td>
              <td>Elisa de Oliveira Ramos</td>
              <td>425.653.987.56</td>
              <td>Olivio da Conseição de Oliveira</td>
              <td>15/05/2013</td>
              <td></td>
            </tr>
          </tbody>

          <tfoot>
            <tr>
              <th>ID</th>
              <th>Vítima</th>
              <th>CPF da Vítima</th>
              <th>Agressor</th>
              <th>Data de Criação</th>
              <th>Opções</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->