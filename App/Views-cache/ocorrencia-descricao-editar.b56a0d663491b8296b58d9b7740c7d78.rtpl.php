<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Editar Descrição da Ocorrência</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Editar Descrição da Ocorrência</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Descrição</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

          <div class="row">
            <div class="col-md-12">
              <?php if( $error != '' ){ ?>
              <div class="alert alert-danger">
                <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
              </div>
              <?php } ?>
            </div>
          </div>

          <?php $counter1=-1;  if( isset($descricao) && ( is_array($descricao) || $descricao instanceof Traversable ) && sizeof($descricao) ) foreach( $descricao as $key1 => $value1 ){ $counter1++; ?>
          <form action="/ocorrencia-descricao-editar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idCriarApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

          <!--Row-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-tipo-ocorrencia">Tipo da Ocorrência *</label>
                <input type="text" name="tipoApuracao" id="id-tipo-ocorrencia" class="form-control" placeholder="Digite o Tipo da Ocorrência" maxlength="70" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $value1["tipoApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
          </div>
          <!--Fim Row-->
          <br>
          <!--Row-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-descricao">Descrição da Ocorrência</label>
                <textarea name="descricaoApuracao" id="id-descricao" class="form-control" rows="10"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
              </div>
            </div>
          </div>
          <!--Fim Row-->
          <?php } ?>

          <!--Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" value="Editar">
              <a href="/ocorrencia-descricao/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left margin">Voltar</a> 
            </div>
          </div>
          <!--Fim Row-->
        </form>
        <!--Fim Form-->

      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->