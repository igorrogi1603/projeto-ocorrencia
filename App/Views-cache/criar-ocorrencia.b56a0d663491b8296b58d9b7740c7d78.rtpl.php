<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Criar Ocorrência</h1>

    <ol class="breadcrumb">
      <li><a href="inicio.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Criar Ocorrência</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Inicio Formulario-->
    <form action="" method="post">

      <!-- Box Dadados da Vitima -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Dados da Vítima</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!--Nome Completo da Vitima-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-vitima">Nome Completo da Vítima *</label>
                <input type="text" name="nome-vitima" id="id-nome-vitima" class="form-control" placeholder="Digite o nome aqui" maxlength="70" required>
              </div>
            </div>
            <!--Fim Nome Completo da Vitima-->

            <!--Data de Nascimento da Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label>Data de Nascimento</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="data-nasc" class="form-control">
                </div>
              </div>
            </div>
            <!--Data de Nascimento da Vitima-->

            <!--Sexo-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-sexo-vitima">Sexo</label>
                <select class="form-control select2" name="sexo-vitima" id="id-sexo-vitima">
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
                </select>
              </div>
            </div>
            <!--Fim Sexo-->
          </div>
          <!-- /.row -->

          <!--Inicio row-->
          <div class="row">
            <div class="col-md-3">
              <!--CPF-->
              <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf-vitima" id="cpf" class="form-control">
              </div>
              <!--Fim CPF-->
            </div>
          </div>
          <!--Fim row-->

        </div>
        <!-- /.box-body -->
        
      </div>
      <!--Fim Box Dados da Vitima-->

    </form>
    <!--Fim Formulario-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->