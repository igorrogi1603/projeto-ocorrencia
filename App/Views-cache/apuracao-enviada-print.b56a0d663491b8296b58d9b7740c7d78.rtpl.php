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
          <small class="pull-right">Date: 2/10/2014</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

    <div class="row">
      <div class="col-xs-12">
        <small class="pull-right">N° da Ocorrência: 125</small>
      </div>
    </div>

    <!--Corpo do relatorio
    -------------------------------->
    <h2><strong>Dados da Apuração</strong></h2>
    <hr>

    <!--Dados da Vitima-->
    <h3><strong>Dados da Vítima</strong></h3>
    <!--Inicio Row-->
    <div class="row">
      <!--Dados-->
      <div class="col-sm-4 invoice-col">
        <p class="sem-espacamento"><strong>Nome: </strong>Nome completo da vitima</p>
        <p class="sem-espacamento"><strong>Da mesma família: </strong>Sim</p>
        <p class="sem-espacamento"><strong>Sexo: </strong>Masculino</p>
        <p class="sem-espacamento"><strong>CPF: </strong>000.000.000-00</p>
        <p class="sem-espacamento"><strong>Celular: </strong>00000-0000</p>
      </div>
      <!--Fim Dados-->

      <!--Dados dos pais e responsaveis-->
      <div class="col-sm-4 invoice-col">
        <p class="sem-espacamento"><strong>Responsavel: </strong>Nome completo responsavel</p>
        <p class="sem-espacamento"><strong>CPF: </strong>000.000.000-00</p>
        <p class="sem-espacamento"><strong>Celular: </strong>00000-0000</p>
      </div>
      <!--Fim Dados dos pais e responsaveis-->

      <!--Endereco da vitima-->
      <div class="col-sm-4 invoice-col">
        <p class="sem-espacamento"><strong>Rua: </strong>Nome da rua da vitima</p>
        <p class="sem-espacamento"><strong>Bairro: </strong>Nome do bairro da vitima</p>
        <p class="sem-espacamento"><strong>Numero: </strong>0000</p>
        <p class="sem-espacamento"><strong>Estado: </strong>Estado da vitima</p>
        <p class="sem-espacamento"><strong>Cidade: </strong>Cidade da vitima</p>
        <p class="sem-espacamento"><strong>Complemento: </strong>Completo da vitima</p>
      </div>
      <!--Fim Endereco da vitima-->
    </div>
    <!--Fim Row-->
    <!--Fim Dados da Vitima-->
    
    <br>
    <hr>

    <!--Dados da Ocorrencia-->
    <h3><strong>Dados da Ocorrência</strong></h3>
    <!--Tipo da ocorrencia-->
    <div class="row">
      <div class="col-md-12">
        <p class=""><strong>Tipo da Ocorrência: </strong>Violência doméstica</p>
      </div>
    </div>
    <!--Fim Tipo da ocorrencia-->

    <!--Descricao da ocorrencia-->
    <div class="row">
      <div class="col-md-12">
        <p class="sem-espacamento"><strong>Descrição da Ocorrência: </strong>É simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
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
