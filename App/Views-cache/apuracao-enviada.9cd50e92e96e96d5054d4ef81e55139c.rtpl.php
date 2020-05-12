<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ocorrência Enviada</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Ocorrência Enviada</li>
    </ol>
  </section>

  <div class="pad margin no-print">
    <div class="callout callout-success" style="margin-bottom: 0!important;">
      <h4>Aviso:</h4>
      A apuração foi salva com sucesso, para mais informações acessar a área de ocorrências abertas.
    </div>
  </div>

  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Sistema de Ocorrência Municipal
          <small class="pull-right">Date: <?php echo htmlspecialchars( $apuracaoCompleta["0"]["dataRegistro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row">
      <div class="col-xs-12">
        <small class="pull-right">N° da Apuracao: <?php echo htmlspecialchars( $apuracaoCompleta["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small>
      </div>
    </div>

    <!--Corpo do relatorio
    -------------------------------->

    <?php $counter1=-1;  if( isset($apuracaoCompleta) && ( is_array($apuracaoCompleta) || $apuracaoCompleta instanceof Traversable ) && sizeof($apuracaoCompleta) ) foreach( $apuracaoCompleta as $key1 => $value1 ){ $counter1++; ?>

    <!--Dados da Vitima-->
    <h3><strong>Dados da Vítima</strong></h3>
    <!--Inicio Row-->
    <div class="row">
      <!--Dados-->
      <div class="col-md-4">
        <p class="sem-espacamento"><strong>Nome: </strong><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Qual Família: </strong><?php echo htmlspecialchars( $value1["qualFamilia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <?php if( $value1["sexoVitima"] == 'm' ){ ?>
        <p class="sem-espacamento"><strong>Sexo: </strong>Masculino</p>
        <?php } ?>
        <?php if( $value1["sexoVitima"] == 'f' ){ ?>
        <p class="sem-espacamento"><strong>Sexo: </strong>Feminino</p>
        <?php } ?>
        <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpfVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celularVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
      </div>
      <!--Fim Dados-->

      <!--Dados dos pais e responsaveis-->
      <div class="col-md-4">
        <p class="sem-espacamento"><strong>Responsavel: </strong><?php echo htmlspecialchars( $value1["nomeResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpfResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celularResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
      </div>
      <!--Fim Dados dos pais e responsaveis-->

      <!--Endereco da vitima-->
      <div class="col-md-4">
        <p class="sem-espacamento"><strong>Cep: </strong><?php echo htmlspecialchars( $value1["cepVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Rua: </strong><?php echo htmlspecialchars( $value1["ruaVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Bairro: </strong><?php echo htmlspecialchars( $value1["bairroVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Numero: </strong><?php echo htmlspecialchars( $value1["numeroVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Estado: </strong><?php echo htmlspecialchars( $value1["estadoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Cidade: </strong><?php echo htmlspecialchars( $value1["cidadeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Complemento: </strong><?php echo htmlspecialchars( $value1["complementoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
      </div>
      <!--Fim Endereco da vitima-->
    </div>
    <!--Fim Row-->
    <!--Fim Dados da Vitima-->
    <br>
    <hr> 

    <?php } ?>

    <!--Dados da Ocorrencia-->
    <h3><strong>Dados da Ocorrência</strong></h3>
    <!--Tipo da ocorrencia-->
    <div class="row">
      <div class="col-md-12">
        <p class=""><strong>Tipo da Ocorrência: </strong><?php echo htmlspecialchars( $apuracaoCompleta["0"]["tipoApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
      </div>
    </div>
    <!--Fim Tipo da ocorrencia-->

    <!--Descricao da ocorrencia-->
    <div class="row">
      <div class="col-md-12">
        <p class="sem-espacamento"><strong>Descrição da Ocorrência: </strong><?php echo htmlspecialchars( $apuracaoCompleta["0"]["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
      </div>
    </div>
    <!--Fim Descricao da ocorrencia-->
    <!--Dados da Ocorrencia-->

    <!--Fim Corpo do relatorio-->

    <br>
    <hr>
    <br>
    
    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="/apuracao-enviada-print/<?php echo htmlspecialchars( $apuracaoCompleta["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</a>
        <a href="/" class="btn btn-primary pull-right">Finalizar</a>
      </div>
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>
<!-- /.content-wrapper -->