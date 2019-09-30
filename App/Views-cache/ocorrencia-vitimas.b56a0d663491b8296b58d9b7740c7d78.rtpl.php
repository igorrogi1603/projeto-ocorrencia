<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Vítimas</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Vítimas</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Dados da Vítima</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php $counter1=-1;  if( isset($vitima) && ( is_array($vitima) || $vitima instanceof Traversable ) && sizeof($vitima) ) foreach( $vitima as $key1 => $value1 ){ $counter1++; ?>
        <?php if( $idVitima == $value1["idVitimasApuracao"] ){ ?>
        <div class="row">
          <!--Vitima-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Nome da Vítima: </strong><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Data de Nascimento: </strong><?php echo htmlspecialchars( $value1["dataNascVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $value1["sexoVitima"] == 'm' ){ ?>
            <p class="sem-espacamento"><strong>Sexo: </strong>Masculino</p>
            <?php } ?>
            <?php if( $value1["sexoVitima"] == 'f' ){ ?>
            <p class="sem-espacamento"><strong>Sexo: </strong>Feminino</p>
            <?php } ?>
            <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpfVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>RG: </strong><?php echo htmlspecialchars( $value1["rgVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celularVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Telefone Fixo: </strong><?php echo htmlspecialchars( $value1["fixoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>E-mail: </strong><?php echo htmlspecialchars( $value1["emailVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Vitima-->

          <!--Inicio responsavel-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Responsavel: </strong><?php echo htmlspecialchars( $value1["nomeResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpfResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celularResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Telefone Fixo: </strong><?php echo htmlspecialchars( $value1["fixoResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>E-mail: </strong><?php echo htmlspecialchars( $value1["emailResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
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
        <?php } ?>
        <?php } ?>
        
        <br>
        <hr>
        <br>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            <?php $counter1=-1;  if( isset($vitima) && ( is_array($vitima) || $vitima instanceof Traversable ) && sizeof($vitima) ) foreach( $vitima as $key1 => $value1 ){ $counter1++; ?>
            <?php if( $idVitima == $value1["idVitimasApuracao"] ){ ?>

            <a href="/ocorrencia-vitima-editar/<?php echo htmlspecialchars( $value1["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-edit"></i>Editar Vítima</a>

            <a href="/ocorrencia-responsavel-vitima-editar" class="btn btn-app"><i class="fa fa-user"></i>Editar Responsavel</a>

            <a href="/ocorrencia-vitima-ver-arquivo" class="btn btn-app"><i class="fa fa-eye"></i>Ver Arquivos</a>

            <a href="/ocorrencia-vitima-ver-arquivo" class="btn btn-app"><i class="fa fa-eye"></i>Acompanhamento</a>

            <?php } ?>
            <?php } ?>
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