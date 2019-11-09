<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Solicitações
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Solicitações</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Pastas</h3>

            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li class="active"><a href="/solicitacoes"><i class="fa fa-inbox"></i> Caixa de Entrada
                <span class="label label-primary pull-right">12</span></a></li>
              <li><a href="/solicitacoes-lixeira"><i class="fa fa-trash-o"></i> Lixeira</a></li>
            </ul>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Ler Solicitação</h3>
          </div>
          <?php $counter1=-1;  if( isset($mensagem) && ( is_array($mensagem) || $mensagem instanceof Traversable ) && sizeof($mensagem) ) foreach( $mensagem as $key1 => $value1 ){ $counter1++; ?>
          <div id="div-impressao">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo htmlspecialchars( $value1["assunto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                <h5>Para: <?php echo htmlspecialchars( $value1["nomeDestinatario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                <h5>Vítima: <?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                  <span class="mailbox-read-time pull-right"><?php echo htmlspecialchars( $value1["dataCriacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></h5>
              </div>

              <div class="mailbox-read-message">
                <p style="text-align: justify;"><?php echo htmlspecialchars( $value1["mensagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            
            <?php if( $value1["isResposta"] == '1' ){ ?>
            <div class="box-footer">
              <h4>Resposta</h4>

              <p><?php echo htmlspecialchars( $value1["resposta"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            </div>
            <!-- /.box-footer -->
            <?php } ?>
          </div>
          
          <div class="box-footer">
            <?php if( $value1["isResposta"] == '0' ){ ?>
            <div class="pull-right">
              <a href="/solicitacao-responder/<?php echo htmlspecialchars( $value1["idSolicitacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["isInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-reply"></i> Responder</a>
            </div>
            <?php } ?>
            <button type="button" id="btn" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
          </div>
          <!-- /.box-footer -->
          <?php } ?>
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
document.getElementById('btn').onclick = function() {
    var conteudo = document.getElementById('div-impressao').innerHTML,
        tela_impressao = window.open('about:blank');

    tela_impressao.document.write(conteudo);
    tela_impressao.window.print();
    tela_impressao.window.close();
};
</script>