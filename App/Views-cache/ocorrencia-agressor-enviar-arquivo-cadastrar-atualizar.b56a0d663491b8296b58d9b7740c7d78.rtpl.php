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

        <form action="/ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $idArquivo, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $selecionaPessoa["isInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">          
          <!--Inicio Selecione Pessoa-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-selecione-pessoa">Selecione a pessoa</label>
                <select class="form-control select2" name="selecionePessoa" id="id-selecione-pessoa">
                  <option value="<?php echo htmlspecialchars( $selecionaPessoa["isInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>-<?php echo htmlspecialchars( $selecionaPessoa["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $selecionaPessoa["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                </select>
              </div>
            </div>
          </div>
          <!--Fim Selecione Pessoa-->

          <!--Inicio Selecione Documento-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" id="id-selecione-documento-hidden" value="">
                <label for="id-selecione-documento">Selecione o documento</label>
                <select class="form-control select2" name="selecioneDocumento" id="id-selecione-documento">
                  <?php if( $tipo == 1 ){ ?>
                  <option value="cpf">CPF</option>
                  <?php } ?>
                  <?php if( $tipo == 2 ){ ?>
                  <option value="rg">RG</option>
                  <?php } ?>
                  <?php if( $tipo == 3 ){ ?>
                  <option value="cnh">CNH</option>
                  <?php } ?>
                  <?php if( $tipo == 4 ){ ?>
                  <option value="cn">Certidão de Nascimento</option>
                  <?php } ?>
                  <?php if( $tipo == 5 ){ ?>
                  <option value="cnpj">CNPJ</option>
                  <?php } ?>
                </select>
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
              <a href="/ocorrencia-agressor-enviar-arquivo/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left">Voltar</a>
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