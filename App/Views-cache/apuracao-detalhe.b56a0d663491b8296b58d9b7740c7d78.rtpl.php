<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Apuração</li>
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
          <div class="col-md-12">
            <p class="sem-espacamento"><strong>N° da Ocorrência: </strong><?php echo htmlspecialchars( $detalheApuracao["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Data: </strong><?php echo htmlspecialchars( $detalheApuracao["0"]["dataRegistro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Usuário que abriu: </strong><?php echo htmlspecialchars( $detalheApuracao["0"]["quemCriouApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Detalhes-->
        </div>
        <!--Fim Row-->

        <br><hr>

        <?php $counter1=-1;  if( isset($detalheApuracao) && ( is_array($detalheApuracao) || $detalheApuracao instanceof Traversable ) && sizeof($detalheApuracao) ) foreach( $detalheApuracao as $key1 => $value1 ){ $counter1++; ?>
        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            <h3><strong>Dados Vítima</strong></h3>
          </div>
        </div>
        <!--Fim Row-->

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

        <!--Inicio Row-->
        <div class="row">
          <!--Detalhes-->
          <div class="col-md-12">
            <p class="sem-espacamento"><strong>Tipo da Ocorrência: </strong><?php echo htmlspecialchars( $detalheApuracao["0"]["tipoApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Descrição: </strong><?php echo htmlspecialchars( $detalheApuracao["0"]["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Detalhes-->
        </div>
        <!--Fim Row-->
        <br>
        <hr>
        <br>
        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            
            <a href="/apuracao-detalhe/gerar-ocorrencia/<?php echo htmlspecialchars( $detalheApuracao["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-th-large"></i>Gerar Ocorrência</a>

            <a href="/apuracao-detalhe/descartar/<?php echo htmlspecialchars( $detalheApuracao["0"]["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-trash-o"></i>Descartar</a>            

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