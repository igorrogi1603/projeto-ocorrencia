<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Lista Usuário</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Lista Usuário</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>CPF</th>
              <th>Cargo</th>
              <th>Setor</th>
              <th>Opções</th>
            </tr>
          </thead>

          <tbody>
            <?php $counter1=-1;  if( isset($listaUsuario) && ( is_array($listaUsuario) || $listaUsuario instanceof Traversable ) && sizeof($listaUsuario) ) foreach( $listaUsuario as $key1 => $value1 ){ $counter1++; ?>

            <tr>
              <td><?php echo htmlspecialchars( $value1["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["funcao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["setor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td>
                <a href="/usuarios-detalhe/<?php echo htmlspecialchars( $value1["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                <?php if( $value1["isBloqueado"] == 0 ){ ?>

                <a href="#" class="btn btn-success"><i class="fa fa-check"></i></a>
                <?php }else{ ?>

                <a href="#" class="btn btn-danger"><i class="fa fa-ban"></i></a>
                <?php } ?>

              </td>
            </tr>
            <?php } ?>

          </tbody>
        </table>
        
      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->