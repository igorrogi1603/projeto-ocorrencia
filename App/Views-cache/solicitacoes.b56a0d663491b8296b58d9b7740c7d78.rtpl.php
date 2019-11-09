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
              <h3 class="box-title">Caixa de Entrada</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php $counter1=-1;  if( isset($mensagem) && ( is_array($mensagem) || $mensagem instanceof Traversable ) && sizeof($mensagem) ) foreach( $mensagem as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1["isLixeira"] == '0' ){ ?>

                  <tr>
                    <?php if( $value1["isInstituicao"] == '1' ){ ?>

                    <td><a href="/ler-solicitacao/<?php echo htmlspecialchars( $value1["idSolicitacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/1"><i class="fa fa-inbox"></i></a></td>
                    <td><a href="/solicitacao-lixeira/<?php echo htmlspecialchars( $value1["idSolicitacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/1"><i class="fa fa-trash"></i></a></td>
                    <td class="mailbox-name"><a href="/ler-solicitacao/<?php echo htmlspecialchars( $value1["idSolicitacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/1"><?php echo htmlspecialchars( $value1["nomeDestinatario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></td>
                    <?php } ?>

                    <?php if( $value1["isInstituicao"] == '0' ){ ?>

                    <td><a href="/ler-solicitacao/<?php echo htmlspecialchars( $value1["idSolicitacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/0"><i class="fa fa-inbox"></i></a></td>
                    <td><a href="/solicitacao-lixeira/<?php echo htmlspecialchars( $value1["idSolicitacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/0"><i class="fa fa-trash"></i></a></td>
                    <td class="mailbox-name"><a href="/ler-solicitacao/<?php echo htmlspecialchars( $value1["idSolicitacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/0"><?php echo htmlspecialchars( $value1["funcaoDestinatario"], ENT_COMPAT, 'UTF-8', FALSE ); ?> </a></td>
                    <?php } ?>

                    <td class="mailbox-subject" style="overflow: hidden; max-width:500px; text-overflow: ellipsis; white-space:nowrap;"><b><?php echo htmlspecialchars( $value1["assunto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b> - <?php echo htmlspecialchars( $value1["mensagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["mensagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                    </td>
                    <td class="mailbox-date"><?php echo htmlspecialchars( $value1["dataCriacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  </tr>
                  <?php } ?>

                  <?php } ?>

                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <a href="/solicitacoes" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
              </div>
            </div>
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