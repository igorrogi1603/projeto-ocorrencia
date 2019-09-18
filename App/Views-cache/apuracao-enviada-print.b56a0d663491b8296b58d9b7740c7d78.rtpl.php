<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/res/site/bootstrap/css/bootstrap.min.css">
  <!--Local css-->
  <link rel="stylesheet" type="text/css" href="/res/site/dist/css/local-css.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/site/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
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
    <h2><strong>Dados da Apuração</strong></h2>
    <hr>

    <?php $counter1=-1;  if( isset($apuracaoCompleta) && ( is_array($apuracaoCompleta) || $apuracaoCompleta instanceof Traversable ) && sizeof($apuracaoCompleta) ) foreach( $apuracaoCompleta as $key1 => $value1 ){ $counter1++; ?>

    <!--Dados da Vitima-->
    <h3><strong>Dados da Vítima</strong></h3>
    <!--Inicio Row-->
    <div class="row">
      <!--Dados-->
      <div class="col-sm-4 invoice-col">
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
      <div class="col-sm-4 invoice-col">
        <p class="sem-espacamento"><strong>Responsavel: </strong><?php echo htmlspecialchars( $value1["nomeResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpfResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celularResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
      </div>
      <!--Fim Dados dos pais e responsaveis-->

      <!--Endereco da vitima-->
      <div class="col-sm-4 invoice-col">
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
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
