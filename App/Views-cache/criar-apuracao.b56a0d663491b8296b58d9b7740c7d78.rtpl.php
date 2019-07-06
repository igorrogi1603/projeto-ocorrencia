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
        
        <div class="row">
          <div class="col-md-12">
            <h3 class="titulo-h3">Dados da Apuração</h3>
          </div>
        </div>

        <hr>
        <br>

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Deve marcar quantas vítimas estão envolvidas e se pertencem a mesma família.<br>
          Caso forem da mesma família na próxima etapa o endereço deve ser preenchido iguais para as duas vítimas.
        </div>

        <!--Inicio Form-->
        <form action="/apuracao-enviada" method="post">

          <div id="dynamicDiv"></div>

          <a class="btn btn-default btn-block" href="javascript:void(0)" id="addInput">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Adicionar Vítima
          </a>

          <br>

          <!-------------------------------------------------------------->
          <!-------------------------------------------------------------->
          <!--              Box Dadados da Ocorrencia                   -->
          <!-------------------------------------------------------------->
          <!-------------------------------------------------------------->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dados da Ocorrência</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <!--Inicio Row-->
              <div class="row">
                <!--Tipo da Ocorrencia-->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id-tipo-da-ocorrencia">Tipo da Ocorrência</label>
                    <input type="text" name="tipo-da-ocorrencia" id="id-tipo-da-ocorrencia" class="form-control" maxlength="100">
                  </div>
                </div>
                <!--Fim Tipo da Ocorrencia-->

                <!--Descricao da Ocorrencia-->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id-descricao-da-ocorrencia">Descrição da Ocorrência</label>
                    <textarea name="descricao-da-ocorrencia" id="id-descricao-da-ocorrencia" class="form-control" rows="10"></textarea>
                  </div>
                </div>
                <!--Fim Descricao da Ocorrencia-->            
              </div>
              <!--Fim Row-->
            </div>
            <!--Fim box-body -->
          </div>
          <!--Fim Box Dados da Ocorrencia-->

          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" value="Enviar">
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