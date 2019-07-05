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

    <!--Dados da Vitima-->
    <h3><strong>Dados da Vítima</strong></h3>
    <!--Inicio Row-->
    <div class="row">
      <!--Dados-->
      <div class="col-md-4">
        <p class="sem-espacamento"><strong>Nome: </strong>Nome completo da vitima</p>
        <p class="sem-espacamento"><strong>Sexo: </strong>Masculino</p>
        <p class="sem-espacamento"><strong>CPF: </strong>000.000.000-00</p>
        <p class="sem-espacamento"><strong>Celular: </strong>00000-0000</p>
      </div>
      <!--Fim Dados-->

      <!--Dados dos pais e responsaveis-->
      <div class="col-md-4">
        <p class="sem-espacamento"><strong>Pai: </strong>Nome do pai completo</p>
        <p class="sem-espacamento"><strong>Mãe: </strong>Nome da mãe completo</p>
        <p class="sem-espacamento"><strong>Os pais são os responsaveis: </strong>Não</p>
        <!--Caso os pais nao forem responsaveis mostrar essa linha caso eles for responsaveis ocultar essa linha-->
        <p class="sem-espacamento"><strong>Responsavel: </strong>Nome completo responsavel</p>
        <p class="sem-espacamento"><strong>CPF: </strong>000.000.000-00</p>
        <p class="sem-espacamento"><strong>Celular: </strong>00000-0000</p>
      </div>
      <!--Fim Dados dos pais e responsaveis-->

      <!--Endereco da vitima-->
      <div class="col-md-4">
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

    <br>
    <hr>
    <br>
    
    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="/apuracao-enviada-print" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</a>
      </div>
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>
<!-- /.content-wrapper -->