<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Confirmação da Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Confirmação da Apuração</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Detalhes</h3>

        <!--<div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>-->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!--Inicio Row-->
        <div class="row">
          <!--Detalhes-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>N° da Ocorrência: </strong>251</p>
            <p class="sem-espacamento"><strong>Data: </strong>15/05/2013</p>
            <p class="sem-espacamento"><strong>Tipo da Ocorrência: </strong>Violência doméstica</p>
            <p class="sem-espacamento"><strong>Status: </strong>Aberta</p>
          </div>
          <!--Fim Detalhes-->

          <!--Vitima-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Nome da Vítima: </strong>Nome completo da vitima</p>
            <p class="sem-espacamento"><strong>Sexo: </strong>Masculino</p>
            <p class="sem-espacamento"><strong>CPF: </strong>000.000.000-00</p>
            <p class="sem-espacamento"><strong>Celular: </strong>00000-0000</p>
            <p class="sem-espacamento"><strong>Responsavel: </strong>Nome completo responsavel</p>
            <p class="sem-espacamento"><strong>CPF: </strong>000.000.000-00</p>
            <p class="sem-espacamento"><strong>Celular: </strong>00000-0000</p>
          </div>
          <!--Fim Vitima-->

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
        
        <br>
        <hr>
        <br>

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Pelo menos dois conselheiro precisa confirmar a apuração para ser transformada em ocorrência. <br>
          Se dois conselheiro não confirmar essa apuração será apagada.
        </div>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            <h4>Confirmar</h4>
            <p class="sem-espacamento"><strong>Quem abriu: </strong>Nome do conselheiro</p>
            <p class="sem-espacamento"><strong>Confirmações: </strong>01/02</p>
            <p class="sem-espacamento"><strong>Confirmações Negadas: </strong>00/00</p>
          </div>
        </div>
        <!--Fim Row-->

        <br>
        <hr>
        <br>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            
            <a href="#" class="btn btn-app"><i class="fa fa-check"></i>Confirmar</a>

            <a href="#" class="btn btn-app"><i class="fa fa-remove"></i>Não Confirmar</a>            

          </div>
        </div>
        <!--Fim Row-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->