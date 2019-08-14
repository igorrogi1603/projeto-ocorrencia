<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Cadastrar Usuário</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Cadastrar Usuário</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>CPF</th>
              <th>Cargo</th>
              <th>Setor</th>
              <th>Data de Criação</th>
              <th>Opções</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>251</td>
              <td>Elisa de Oliveira Ramos</td>
              <td>425.653.987.56</td>
              <td>Diretor</td>
              <td>Educação</td>
              <td>15/05/2013</td>
              <td>
                <a href="/apuracao-detalhe" class="btn btn-default"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        
      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->