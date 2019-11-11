<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Confirmar Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Confirmar Apuração</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <div style="overflow: auto; width: 100%; height: 100%;">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Vítima</th>
                <th>Quem Gerou a Ocorrência</th>
                <th>Data de Criação</th>
                <th>Opções</th>
              </tr>
            </thead>

            <tbody>
              <?php $counter1=-1;  if( isset($confirmarApuracao) && ( is_array($confirmarApuracao) || $confirmarApuracao instanceof Traversable ) && sizeof($confirmarApuracao) ) foreach( $confirmarApuracao as $key1 => $value1 ){ $counter1++; ?>
              <?php if( $value1["status"] == 2 ){ ?>
              <tr>
                <td><?php echo htmlspecialchars( $value1["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["nomeGerouOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["registroConfirmacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td>
                  <a href="/confirmar-apuracao-detalhe/<?php echo htmlspecialchars( $value1["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                </td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->