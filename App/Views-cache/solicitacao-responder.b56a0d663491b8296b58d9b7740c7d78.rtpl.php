<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Solicitações
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Responder Solicitação</li>
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
                  <span class="label label-primary pull-right">12</span></a>
                </li>
                <li><a href="/solicitacoes-lixeira"><i class="fa fa-trash-o"></i> Lixeira</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

        <form action="/solicitacao-responder/<?php echo htmlspecialchars( $idSolicitacao, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $isInstituicao, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Responder Solicitação</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="sem-espacamento"><strong>Solicitação: </strong><?php echo htmlspecialchars( $idSolicitacao, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                  </div>
                </div>

                <br><hr><br>

                <div class="form-group">
                  <label for="solicitacao-mensagem">Mensagem:</label>
                  <textarea id="solicitacao-mensagem" name="mensagem" class="form-control" rows="10" placeholder="Mensagem:"></textarea>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                </div>
                <a href="/ler-solicitacao/<?php echo htmlspecialchars( $idSolicitacao, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $isInstituicao, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-times"></i> Excluir</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </form>
        <!--Fim Form-->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->