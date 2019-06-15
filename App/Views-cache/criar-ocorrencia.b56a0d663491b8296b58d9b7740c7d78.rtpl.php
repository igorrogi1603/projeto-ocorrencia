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
      <div class="box box-primary">
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
                <label>Data de Nascimento *</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="id-data-nasc-vitima" class="form-control" placeholder="__/__/____" required>
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
            <!--CPF-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-cpf-vitima">CPF</label>
                <input type="text" name="cpf-vitima" id="id-cpf-vitima" class="form-control" placeholder="___.___.___-__">
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-rg-vitima">RG</label>
                <input type="text" name="rg-vitima" id="id-rg-vitima" class="form-control" placeholder="__.___.___">
              </div>
            </div>
            <!--Fim RG-->

            <!--Telefone Fixo Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-vitima">Telefone Fixo</label>
                <input type="text" name="telfixo-vitima" id="id-telfixo-vitima" class="form-control" placeholder="(__)____-____">
              </div>
            </div>
            <!--Telefone Fixo Vitima-->

            <!--Celular Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-vitima">Celular</label>
                <input type="text" name="celular-vitima" id="id-celular-vitima" class="form-control" placeholder="(__)_____-____">
              </div>
            </div>
            <!--Fim Celular Vitima-->
          </div>
          <!--Fim row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Upload CPF-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-up-cpf-vitima">Upload CPF</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-cpf-vitima" id="id-up-cpf-vitima" class="arquivo" style="display: none;">
                  <input type="text" name="up-cpf-file-vitima" id="id-up-cpf-file-vitima" class="file" placeholder="Upload CPF" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-cpf-vitima" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload CPF-->

            <!--Upload RG-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-up-rg-vitima">Upload RG</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-rg-vitima" id="id-up-rg-vitima" class="arquivo" style="display: none;">
                  <input type="text" name="up-rg-file-vitima" id="id-up-rg-file-vitima" class="file" placeholder="Upload RG" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-rg-vitima" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload RG-->

            <!--Upload Certidao de Nascimento-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-up-cnasc-vitima">Upload Certidão de Nascimento</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-cnasc-vitima" id="id-up-cnasc-vitima" class="arquivo" style="display: none;">
                  <input type="text" name="up-cnasc-file-vitima" id="id-up-cnasc-file-vitima" class="file" placeholder="Upload Certidão" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-cnasc-vitima" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload Certidao de Nascimento-->
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-6">
              
            </div>
          </div>
          <!--Fim Row-->

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