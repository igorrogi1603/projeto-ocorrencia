<?php

$pagina = 

"
<!DOCTYPE html>
<html>
<head>
  <title>AdminLTE 2 | Invoice</title>
  <!-- Bootstrap 3.3.6 -->
  <link rel='stylesheet' href='/res/site/bootstrap/css/bootstrap.min.css'>
  <!--Local css-->
  <link rel='stylesheet' type='text/css' href='/res/site/dist/css/local-css.css'>
  <!-- Font Awesome -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
  <!-- Ionicons -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
  <!-- Theme style -->
  <link rel='stylesheet' href='/res/site/dist/css/AdminLTE.min.css'>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
  <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
  <![endif]-->
</head>
<body onload='window.print();'>
<div class='wrapper'>
  <!-- Main content -->
  <section class='invoice'>
    <!-- title row -->
    <div class='row'>
      <div class='col-xs-12'>
        <h2 class='page-header'>
          <i class='fa fa-globe'></i> Sistema de Ocorrência Municipal
          <small class='pull-right'>Date:</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

    <div class='row'>
      <div class='col-xs-12'>
        <small class='pull-right'>N° da Apuracao: </small>
      </div>
    </div>

    <!--Corpo do relatorio
    -------------------------------->
    <h2><strong>Dados da Apuração</strong></h2>
    <hr>

    <!--Dados da Vitima-->
    <h3><strong>Dados da Vítima</strong></h3>
    <!--Inicio Row-->
    <div class='row'>
      <!--Dados-->
      <div class='col-sm-4 invoice-col'>
        <p class='sem-espacamento'><strong>Nome: </strong></p>
        <p class='sem-espacamento'><strong>Qual Família: </strong></p>
        
        <p class='sem-espacamento'><strong>Sexo: </strong>Masculino</p>
        
        
        <p class='sem-espacamento'><strong>Sexo: </strong>Feminino</p>
        
        <p class='sem-espacamento'><strong>CPF: </strong></p>
        <p class='sem-espacamento'><strong>Celular: </strong></p>
      </div>
      <!--Fim Dados-->

      <!--Dados dos pais e responsaveis-->
      <div class='col-sm-4 invoice-col'>
        <p class='sem-espacamento'><strong>Responsavel: </strong></p>
        <p class='sem-espacamento'><strong>CPF: </strong></p>
        <p class='sem-espacamento'><strong>Celular: </strong></p>
      </div>
      <!--Fim Dados dos pais e responsaveis-->

      <!--Endereco da vitima-->
      <div class='col-sm-4 invoice-col'>
        <p class='sem-espacamento'><strong>Cep: </strong></p>
        <p class='sem-espacamento'><strong>Rua: </strong></p>
        <p class='sem-espacamento'><strong>Bairro: </strong></p>
        <p class='sem-espacamento'><strong>Numero: </strong></p>
        <p class='sem-espacamento'><strong>Estado: </strong></p>
        <p class='sem-espacamento'><strong>Cidade: </strong></p>
        <p class='sem-espacamento'><strong>Complemento: </strong></p>
      </div>
      <!--Fim Endereco da vitima-->
    </div>
    <!--Fim Row-->
    <!--Fim Dados da Vitima-->
    <br>
    <hr> 

    

    <!--Dados da Ocorrencia-->
    <h3><strong>Dados da Ocorrência</strong></h3>

    <!--Quem abriu Apuracao-->
    <div class='row'>
      <div class='col-md-12'>
        <p class=''><strong>Usuário que criou apuração: </strong></p>
      </div>
    </div>
    <!--Fim Quem abriu Apuracao-->

    <!--Tipo da ocorrencia-->
    <div class='row'>
      <div class='col-md-12'>
        <p class=''><strong>Tipo da Apuração: </strong></p>
      </div>
    </div>
    <!--Fim Tipo da ocorrencia-->

    <!--Descricao da ocorrencia-->
    <div class='row'>
      <div class='col-md-12'>
        <p class='sem-espacamento'><strong>Descrição da Apuração: </strong></p>
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
";

?>