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
          <a href="/ocorrencia-nova-solicitacao/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-block margin-bottom">Nova Solicitação</a>

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
                <li class="active"><a href="/ocorrencia-solicitacao/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-inbox"></i> Caixa de Entrada
                  <span class="label label-primary pull-right">12</span></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

        <form action="/ocorrencia-nova-solicitacao/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Nova Solicitação</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="ocorrencia-solicitacao-vitima">Vítima:</label>
                  <select id="ocorrencia-solicitacao-vitima" class="form-control" name="vitima">
                    <?php $counter1=-1;  if( isset($vitima) && ( is_array($vitima) || $vitima instanceof Traversable ) && sizeof($vitima) ) foreach( $vitima as $key1 => $value1 ){ $counter1++; ?>
                    <option value="<?php echo htmlspecialchars( $value1["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ocorrencia-solicitacao-para">Para:</label>
                  <select id="ocorrencia-solicitacao-para" class="form-control" name="para">
                    <?php $counter1=-1;  if( isset($usuarios) && ( is_array($usuarios) || $usuarios instanceof Traversable ) && sizeof($usuarios) ) foreach( $usuarios as $key1 => $value1 ){ $counter1++; ?>
                    <option value="<?php echo htmlspecialchars( $value1["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Para: <?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["funcao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ocorrencia-solicitacao-assunto">Assunto:</label>
                  <input id="ocorrencia-solicitacao-assunto" class="form-control" name="assunto" placeholder="Assunto:">
                </div>
                <div class="form-group">
                  <label for="ocorrencia-solicitacao-mensagem">Mensagem:</label>
                  <textarea id="ocorrencia-solicitacao-mensagem" name="mensagem" class="form-control" rows="10" placeholder="Mensagem:"></textarea>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                </div>
                <a href="/ocorrencia-solicitacao/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-times"></i> Excluir</a>
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