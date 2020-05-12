<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Averiguação</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Averiguação</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Detalhes</h3>

        <!--<div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>-->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!--Inicio Row-->
        <div class="row">
          <!--Detalhes-->
          <div class="col-md-12">
            <p class="sem-espacamento"><strong>N° da Averiguação: </strong><?php echo htmlspecialchars( $lista["idCriarAveriguacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Data: </strong><?php echo htmlspecialchars( $lista["dataRegistro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Detalhes-->
        </div>
        <!--Fim Row-->

        <br>
        <hr>
        <br>

        <div class="row">
          
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Titulo: </strong><?php echo htmlspecialchars( $lista["titulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Mensagem: </strong><?php echo htmlspecialchars( $lista["mensagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          
        </div>

        <br>
        <hr>
        <br>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            
            <?php if( $lista["status"] == 0 ){ ?>
            <a href="/averiguacao-detalhe/lida/<?php echo htmlspecialchars( $lista["idCriarAveriguacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-check"></i>Marcar como Lida</a>        

            <a href="/averiguacao" class="btn btn-app"><i class="fa fa-arrow-left"></i>Voltar</a>
            <?php } ?>

            <?php if( $lista["status"] == 1 ){ ?>
            <a href="/averiguacao-lida" class="btn btn-app"><i class="fa fa-arrow-left"></i>Voltar</a>
            <?php } ?>

          </div>
        </div>
        <!--Fim Row-->

      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->