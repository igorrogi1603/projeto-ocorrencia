<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Acompanhamento Vítima</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Acompanhamento Vítima</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
      
        <!-- /.tab-pane -->
        <div class="tab-pane" id="timeline">
          <!-- The timeline -->
          <ul class="timeline timeline-inverse">
            <?php $counter1=-1;  if( isset($acompanhamento) && ( is_array($acompanhamento) || $acompanhamento instanceof Traversable ) && sizeof($acompanhamento) ) foreach( $acompanhamento as $key1 => $value1 ){ $counter1++; ?>
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?php echo htmlspecialchars( $value1["data"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-map-marker bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars( $value1["hora"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>

                <h3 class="timeline-header"><a href="#">Localização</a></h3>

                <div class="timeline-body">
                  <p class="sem-espacamento"><strong>Cep: </strong><?php echo htmlspecialchars( $value1["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                  <p class="sem-espacamento"><strong>Rua: </strong><?php echo htmlspecialchars( $value1["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                  <p class="sem-espacamento"><strong>Numero: </strong><?php echo htmlspecialchars( $value1["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                  <p class="sem-espacamento"><strong>Bairro: </strong><?php echo htmlspecialchars( $value1["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                  <p class="sem-espacamento"><strong>Cidade: </strong><?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                  <p class="sem-espacamento"><strong>Estado: </strong><?php echo htmlspecialchars( $value1["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                  <p class="sem-espacamento"><strong>Complemento: </strong><?php echo htmlspecialchars( $value1["complemento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
                <div class="timeline-footer">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <?php } ?>
          </ul>
        </div>
        <!-- /.tab-pane -->
        
      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->