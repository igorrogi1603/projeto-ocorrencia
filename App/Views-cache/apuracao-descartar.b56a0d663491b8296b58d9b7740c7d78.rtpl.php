<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Descartar Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Descartar Apuração</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Relatótio de Exclusão da Apuração com <strong>id: <?php echo htmlspecialchars( $idApuracao, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></h3>
      </div>

      <!-- /.box-header -->
      <div class="box-body">

        <form action="/apuracao-detalhe/descartar/<?php echo htmlspecialchars( $idApuracao, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          
          <!--Inicio row-->
          <div class="col-md-12">
            <!--Descricao da Ocorrencia-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-descricao-da-ocorrencia">Descrição do porque está excluindo a apuração *</label>
                <textarea name="descricaoApuracao" id="id-descricao-apuracao" class="form-control" rows="10" required></textarea>
              </div>
            </div>
            <!--Fim Descricao da Ocorrencia-->
          </div>
          <!--Fim row-->
          
          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <a href="/apuracao-detalhe/<?php echo htmlspecialchars( $idApuracao, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left margin" id="botaoCancelar">Cancelar</a>
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Enviar">
            </div>            
          </div>
          <!--Fim Row-->

        </form>

      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
