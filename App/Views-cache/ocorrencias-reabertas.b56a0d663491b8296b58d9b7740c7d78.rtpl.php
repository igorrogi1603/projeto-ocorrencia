<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ocorrências Reabertas</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ocorrências Reabertas</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box">
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
              <td>
                <a href="/ocorrencia-detalhe" class="btn btn-default"><i class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-success"><i class="fa fa-unlock"></i></a>
                <!--<a href="#" class="btn btn-danger"><i class="fa fa-lock"></i></a>-->
              </td>
            </tr>

            <tr>
              <td>252</td>
              <td>Isabel Silva Ramos</td>
              <td>555.673.123.76</td>
              <td>Otavio da Costa de Oliveira</td>
              <td>04/10/2016</td>
              <td>
                <a href="#" class="btn btn-default"><i class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-success"><i class="fa fa-unlock"></i></a>
                <!--<a href="#" class="btn btn-danger"><i class="fa fa-lock"></i></a>-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->