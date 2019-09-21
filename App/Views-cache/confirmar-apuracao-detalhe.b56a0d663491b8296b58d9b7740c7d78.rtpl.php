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

      <!-- /.box-header -->
      <div class="box-body">
        <!--Inicio Row-->
        <div class="row">
          <!--Detalhes-->
          <div class="col-md-12">
            <p class="sem-espacamento"><strong>N° da Ocorrência: </strong><?php echo htmlspecialchars( $confirmacaoDetalhe["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Data: </strong><?php echo htmlspecialchars( $confirmacaoDetalhe["0"]["dataRegistro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Detalhes-->
        </div>
        <!--Fim Row-->

        <?php $counter1=-1;  if( isset($confirmacaoDetalhe) && ( is_array($confirmacaoDetalhe) || $confirmacaoDetalhe instanceof Traversable ) && sizeof($confirmacaoDetalhe) ) foreach( $confirmacaoDetalhe as $key1 => $value1 ){ $counter1++; ?>
        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            <h3><strong>Dados Vítima</strong></h3>
          </div>
        </div>
        <!--Fim Row-->
        <!--Inicio Row-->
        <div class="row">
          <!--Vitima-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Nome da Vítima: </strong><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $value1["sexoVitima"] == 'm' ){ ?>
            <p class="sem-espacamento"><strong>Sexo: </strong>Masculino</p>
            <?php } ?>
            <?php if( $value1["sexoVitima"] == 'f' ){ ?>
            <p class="sem-espacamento"><strong>Sexo: </strong>Feminino</p>
            <?php } ?>
            <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpfVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celularVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Vitima-->

          <!--Inicio responsavel-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Responsavel: </strong><?php echo htmlspecialchars( $value1["nomeResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpfResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celularResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim responsavel-->

          <!--Endereco da vitima-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Cep: </strong><?php echo htmlspecialchars( $value1["cepVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Rua: </strong><?php echo htmlspecialchars( $value1["ruaVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Numero: </strong><?php echo htmlspecialchars( $value1["numeroVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Bairro: </strong><?php echo htmlspecialchars( $value1["bairroVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Cidade: </strong><?php echo htmlspecialchars( $value1["cidadeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Estado: </strong><?php echo htmlspecialchars( $value1["estadoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Complemento: </strong><?php echo htmlspecialchars( $value1["complementoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Endereco da vitima-->
        </div>
        <!--Fim Row-->
        <br><hr>
        <?php } ?>

        <br>

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Pelo menos dois conselheiro precisa confirmar a apuração para ser transformada em ocorrência. <br>
          Se dois conselheiro não confirmar essa apuração será apagada.
        </div>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            <h4>Confirmar</h4>
            <p class="sem-espacamento"><strong>Quem abriu: </strong><?php echo htmlspecialchars( $confirmacaoDetalhe["0"]["nomeGerouOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $confirmacaoDetalhe["0"]["isPositivo"] == 0 ){ ?>
            <p class="sem-espacamento"><strong>Confirmações: </strong>00/02</p>
            <?php } ?>
            <?php if( $confirmacaoDetalhe["0"]["isPositivo"] == 1 ){ ?>
            <p class="sem-espacamento"><strong>Confirmações: </strong>01/02</p>
            <?php } ?>
            <?php if( $confirmacaoDetalhe["0"]["isPositivo"] == 2 ){ ?>
            <p class="sem-espacamento"><strong>Confirmações: </strong>02/02</p>
            <?php } ?>
            <?php if( $confirmacaoDetalhe["0"]["isNegativo"] == 0 ){ ?>
            <p class="sem-espacamento"><strong>Confirmações Negadas: </strong>00/02</p>
            <?php } ?>
            <?php if( $confirmacaoDetalhe["0"]["isNegativo"] == 1 ){ ?>
            <p class="sem-espacamento"><strong>Confirmações Negadas: </strong>01/02</p>
            <?php } ?>
            <?php if( $confirmacaoDetalhe["0"]["isNegativo"] == 2 ){ ?>
            <p class="sem-espacamento"><strong>Confirmações Negadas: </strong>02/02</p>
            <?php } ?>
          </div>
        </div>
        <!--Fim Row-->

        <br>
        <hr>
        <br>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            
            <a onclick="confirmar()" class="btn btn-app"><i class="fa fa-check"></i>Confirmar</a>

            <a onclick="naoConfirmar()" class="btn btn-app"><i class="fa fa-remove"></i>Não Confirmar</a>            

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

<script>

function confirmar()
{
  if(confirm("Voce realmente deseja CONFIRMAR essa apuração")){
    location.href="/confirmacao-positivo/<?php echo htmlspecialchars( $confirmacaoDetalhe["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $confirmacaoDetalhe["0"]["idConfirmacaoApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
  }
}

function naoConfirmar()
{
  if(confirm("Voce realmente deseja NÃO CONFIRMAR essa apuração")){
    location.href="/confirmacao-negativo/<?php echo htmlspecialchars( $confirmacaoDetalhe["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $confirmacaoDetalhe["0"]["idConfirmacaoApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
  }
}

</script>