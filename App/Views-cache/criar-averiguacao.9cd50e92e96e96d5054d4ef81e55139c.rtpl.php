<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Criar Averiguação</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Criar Averiguação</li>
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
            <h3 class="titulo-h3">Dados da Averiguação</h3>
          </div>
        </div>

        <hr>
        <br>

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Essa página serve para cadastrar casos onde não se tem dados suficientes para
          criar uma aparução.
        </div>

        

        <!--Inicio Form-->
        <form action="/criar-averiguacao" method="post">

          <!--Inicio Row-->
          <div class="row">
            <!--Tipo da Ocorrencia-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-titulo-averiguacao">Titulo da Averiguação *</label>
                <input type="text" name="tituloAveriguacao" id="id-titulo-averiguacao" class="form-control" maxlength="45" onkeyup="validarCaracter(this, 3)" required>
              </div>
            </div>
            <!--Fim Tipo da Ocorrencia-->

            <!--Descricao da Ocorrencia-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-mensagem-averiguacao">Descrição da Avriguação *</label>
                <textarea name="mensagemAveriguacao" id="id-mensagem-averiguacao" class="form-control" rows="10" required></textarea>
              </div>
            </div>
            <!--Fim Descricao da Ocorrencia-->            
          </div>
          <!--Fim Row-->

          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Enviar">
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