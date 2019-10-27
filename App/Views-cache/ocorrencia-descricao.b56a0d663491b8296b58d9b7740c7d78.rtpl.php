<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Descrição da Ocorrência</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Descrição da Ocorrência</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Descrição</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        
        <!--Row-->
        <div class="row">
          <div class="col-md-12">
            <a href="/ocorrencia-descricao-editar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-edit"></i>Editar</a>          
          </div>          
        </div>
        <!--Fim Row-->

        <hr><br>

        <?php $counter1=-1;  if( isset($descricao) && ( is_array($descricao) || $descricao instanceof Traversable ) && sizeof($descricao) ) foreach( $descricao as $key1 => $value1 ){ $counter1++; ?>
        <div class="row">
          <div class="col-md-12">
            <p class="sem-espacamento"><strong>Tipo: </strong><?php echo htmlspecialchars( $value1["tipoApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <p class="sem-espacamento"><strong>Descrição: </strong><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
        </div>
        <?php } ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->