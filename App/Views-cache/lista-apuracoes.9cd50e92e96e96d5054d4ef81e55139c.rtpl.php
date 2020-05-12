<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Apurações Abertas</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Apuraçôes Abertas</li>
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
                <th>CPF da Vítima</th>
                <th>Data de Criação</th>
                <th>Opções</th>
              </tr>
            </thead>

            <tbody>
              <?php $counter1=-1;  if( isset($listaApuracao) && ( is_array($listaApuracao) || $listaApuracao instanceof Traversable ) && sizeof($listaApuracao) ) foreach( $listaApuracao as $key1 => $value1 ){ $counter1++; ?>
              <?php if( $value1["status"] == 1 ){ ?>
              <tr>
                <td><?php echo htmlspecialchars( $value1["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["cpfVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["dataCriacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td>
                  <a href="/apuracao-detalhe/<?php echo htmlspecialchars( $value1["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
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