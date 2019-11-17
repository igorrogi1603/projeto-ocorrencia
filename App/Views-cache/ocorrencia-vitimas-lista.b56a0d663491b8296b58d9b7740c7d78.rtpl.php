<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Vítimas</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Vítimas</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Vítimas</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div style="overflow: auto; width: 100%; height: 100%;">
          <!--Tabela-->
          <table class="table table-hover">
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>CPF</th>
              <th>Opções</th>
            </tr>
            <?php $counter1=-1;  if( isset($vitimas) && ( is_array($vitimas) || $vitimas instanceof Traversable ) && sizeof($vitimas) ) foreach( $vitimas as $key1 => $value1 ){ $counter1++; ?>
            <tr>
              <td><?php echo htmlspecialchars( $value1["idPessoaVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["cpfVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td>
                <a href="/ocorrencia-vitimas/<?php echo htmlspecialchars( $value1["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
              </td>
            </tr>
            <?php } ?>
          </table>
          <!--Fim Tabela-->
        </div>

        <?php if( $vitimas != null ){ ?>
        <!--Row-->
        <div class="row">
          <div class="col-md-12">
            <a href="/ocorrencia-detalhe/<?php echo htmlspecialchars( $vitimas["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left margin">Voltar</a> 
          </div>
        </div>
        <!--Fim Row-->
        <?php } ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->