<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência</li>
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
        <!--Inicio Row-->
        <div class="row">
          <!--Detalhes-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>N° da Ocorrência: </strong><?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Data: </strong><?php echo htmlspecialchars( $detalheOcorrencia["0"]["dataCriacaoOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 1 ){ ?>
            <p class="sem-espacamento"><strong>Status: </strong>Aberta</p>
            <?php } ?>
            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 2 ){ ?>
            <p class="sem-espacamento"><strong>Status: </strong>Reaberta</p>
            <?php } ?>
            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 3 ){ ?>
            <p class="sem-espacamento"><strong>Status: </strong>Arquivada</p>
            <?php } ?>
            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 4 ){ ?>
            <p class="sem-espacamento"><strong>Status: </strong>Encerrada</p>
            <?php } ?>
          </div>
          <!--Fim Detalhes-->

          <!--Vitimas-->
          <div class="col-md-4">
            <?php $counter1=-1;  if( isset($detalheOcorrencia) && ( is_array($detalheOcorrencia) || $detalheOcorrencia instanceof Traversable ) && sizeof($detalheOcorrencia) ) foreach( $detalheOcorrencia as $key1 => $value1 ){ $counter1++; ?>
            <p class="sem-espacamento"><strong>Nome da Vítima: </strong><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php } ?>
          </div>
          <!--Fim Vitimas-->
        </div>
        <!--Fim Row-->
        
        <br>
        <hr>
        <br>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            
            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 1 ){ ?>
            <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210 ){ ?>
            <a href="/ocorrencia-vitimas-lista/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-user"></i>Vítimas</a>
            <a href="/ocorrencia-agressor/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-user"></i>Agressor</a>
            <a href="/ocorrencia-descricao/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-list-alt"></i>Descrição</a>
            <?php } ?>

            <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210  OR $nivelAcesso == 3748 ){ ?>
            <a href="" class="btn btn-app" onclick="open('/ocorrencia-arquivos/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>','','status=no,Width=1000,Height=600');"><i class="fa fa-folder"></i>Arquivos</a>

            <a href="/ocorrencia-arquivo-externo/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-upload"></i>Enviar Arquivo</a>

            <a href="/ocorrencia-solicitacao/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-envelope"></i>Solicitação</a>
            <a onclick="confirmarArquivar();" class="btn btn-app"><i class="fa fa-inbox"></i>Arquivar</a>
            <a onclick="confirmarEncerrar();" class="btn btn-app"><i class="fa fa-archive"></i>Encerrar</a>
            <?php } ?>
            <?php } ?>
            
            <!------------------------------------------------------------------------------------>

            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 2 ){ ?>
            <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210 ){ ?>
            <a href="/ocorrencia-vitimas-lista/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-user"></i>Vítimas</a>
            <a href="/ocorrencia-agressor/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-user"></i>Agressor</a>
            <a href="/ocorrencia-descricao/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-list-alt"></i>Descrição</a>
            <?php } ?>

            <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210  OR $nivelAcesso == 3748 ){ ?>
            <a href="" class="btn btn-app" onclick="open('/ocorrencia-arquivos/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>','','status=no,Width=1000,Height=600');"><i class="fa fa-folder"></i>Arquivos</a>

            <a href="/ocorrencia-arquivo-externo/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-upload"></i>Enviar Arquivo</a>

            <a href="/ocorrencia-solicitacao/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-envelope"></i>Solicitação</a>
            <a onclick="confirmarArquivar();" class="btn btn-app"><i class="fa fa-inbox"></i>Arquivar</a>
            <a onclick="confirmarEncerrar();" class="btn btn-app"><i class="fa fa-archive"></i>Encerrar</a>            
            <?php } ?>
            <?php } ?>

            <!------------------------------------------------------------------------------------>

            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 3 ){ ?>
            <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210  OR $nivelAcesso == 3748 ){ ?>
            <a onclick="open('/ocorrencia-arquivos/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>','','status=no,Width=1000,Height=600');" class="btn btn-app"><i class="fa fa-folder"></i>Arquivos</a>
            <a onclick="confirmarReabrir();" class="btn btn-app"><i class="fa fa-inbox"></i>Reabrir</a>
            <?php } ?>
            <?php } ?>

            <!------------------------------------------------------------------------------------>

            <?php if( $detalheOcorrencia["0"]["statusOcorrencia"] == 4 ){ ?>
            <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210  OR $nivelAcesso == 3748 ){ ?>
            <a onclick="open('/ocorrencia-arquivos/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>','','status=no,Width=1000,Height=600');" class="btn btn-app"><i class="fa fa-folder"></i>Arquivos</a>
            <a onclick="confirmarReabrir();" class="btn btn-app"><i class="fa fa-inbox"></i>Reabrir</a>
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

<script>
function confirmarArquivar()
{
  if(confirm("Voce realmente deseja ARQUIVAR essa ocorrência?")){
    location.href="/ocorrencia-detalhe/arquivar/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
  }
}

function confirmarEncerrar()
{
  if(confirm("Voce realmente deseja ENCERRAR essa ocorrência?")){
    location.href="/ocorrencia-detalhe/encerrar/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
  }
}

function confirmarReabrir()
{
  if(confirm("Voce realmente deseja REABRIR essa ocorrência?")){
    location.href="/ocorrencia-detalhe/reabrir/<?php echo htmlspecialchars( $detalheOcorrencia["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
  }
}
</script>