<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe do Responsável</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe do Responsável</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Detalhes</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php $counter1=-1;  if( isset($responsavel) && ( is_array($responsavel) || $responsavel instanceof Traversable ) && sizeof($responsavel) ) foreach( $responsavel as $key1 => $value1 ){ $counter1++; ?>
        <div class="row">
          <!--Vitima-->
          <div class="col-md-6">
            <p class="sem-espacamento"><strong>Nome: </strong><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Data de Nascimento: </strong><?php echo htmlspecialchars( $value1["dataNasc"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $value1["sexo"] == 'm' ){ ?>
            <p class="sem-espacamento"><strong>Sexo: </strong>Masculino</p>
            <?php } ?>
            <?php if( $value1["sexo"] == 'f' ){ ?>
            <p class="sem-espacamento"><strong>Sexo: </strong>Feminino</p>
            <?php } ?>
            <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $value1["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>RG: </strong><?php echo htmlspecialchars( $value1["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $value1["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Telefone Fixo: </strong><?php echo htmlspecialchars( $value1["fixo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>E-mail: </strong><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Vitima-->

          <!--Endereco da vitima-->
          <div class="col-md-6">
            <p class="sem-espacamento"><strong>Cep: </strong><?php echo htmlspecialchars( $value1["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Rua: </strong><?php echo htmlspecialchars( $value1["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Numero: </strong><?php echo htmlspecialchars( $value1["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Bairro: </strong><?php echo htmlspecialchars( $value1["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Cidade: </strong><?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Estado: </strong><?php echo htmlspecialchars( $value1["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Complemento: </strong><?php echo htmlspecialchars( $value1["complemento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Endereco da vitima-->
        </div>
        <!--Fim Row-->
        <?php } ?>
        <br>
        <hr>
        <br>

        <!--Row-->
        <div class="row">
          <div class="col-md-12">
            <a href="/ocorrencia-responsavel-vitima-lista/<?php echo htmlspecialchars( $idVitima, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-right margin">Voltar</a>
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