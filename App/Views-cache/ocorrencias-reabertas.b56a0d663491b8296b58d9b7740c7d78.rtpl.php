<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ocorrências Reabertas</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ocorrências Reabertas</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Vítima</th>
              <th>CPF da Vítima</th>
              <th>Data de Criação</th>
              <th>Opções</th>
            </tr>
          </thead>

          <tbody>
            <?php $counter1=-1;  if( isset($listaOcorrencia) && ( is_array($listaOcorrencia) || $listaOcorrencia instanceof Traversable ) && sizeof($listaOcorrencia) ) foreach( $listaOcorrencia as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1["statusOcorrencia"] == 2 ){ ?>

            <tr>
              <td><?php echo htmlspecialchars( $value1["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["cpfVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["dataCriacaoOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td>
                <a href="/ocorrencia-detalhe/<?php echo htmlspecialchars( $value1["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
            <?php } ?>

            <?php } ?>

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->