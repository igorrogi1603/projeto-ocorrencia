<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Enviar Arquivos</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Enviar Arquivos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!--Box Detalhes-->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Dados</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Nessa página enviar apenas documentos pessoais de cada um como <strong>CPF, RG, CNH e Certidão de Nascimento</strong>
          <br><strong>Todos em PDF</strong>
        </div>

        <div class="row">
          <div class="col-md-12">
            <?php if( $error != '' ){ ?>
            <div class="alert alert-danger">
              <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
          </div>
        </div>

        <form action="/ocorrencia-arquivo-externo/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">          

          <!--Inicio Selecione Documento-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-tipo">Tipo do documento</label>
                <input type="text" class="form-control" name="tipo" id="id-tipo" placeholder="Informe o tipo do documento">
              </div>
            </div>
          </div>
          <!--Fim Selecione Documento-->

          <!--Upload CPF-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-up-documento">Upload Documento</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="upDocumento" id="id-up-documento" class="arquivo" style="display: none;">
                  <input type="text" name="upDocumentoFile" id="id-up-documento-file" class="file" placeholder="Upload do Documento" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-documento" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!--Fim Upload CPF-->

          <hr>
          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right" value="Enviar">
              <a href="/ocorrencia-detalhe/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left">Voltar</a>
            </div>            
          </div>
          <!--Fim Row-->
        </form>
        <!--Fim form-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->