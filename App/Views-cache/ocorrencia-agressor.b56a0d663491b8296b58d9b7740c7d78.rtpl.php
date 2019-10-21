<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Lista de Agressor</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Lista de Agressor</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Agressor</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <!--Row-->
        <div class="row">
          <div class="col-md-6">
            <a href="/ocorrencia-agressor-cadastrar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-user-plus"></i>Novo Agressor</a>          
            <a href="/ocorrencia-agressor-enviar-arquivo/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-file-pdf-o"></i>Enviar Documentos</a>
          </div>          
        </div>
        <!--Fim Row-->

        <br>

        <!--Tabela-->
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF / CNPJ</th>
            <th>Tipo</th>
            <th>Status</th>
            <th>Opções</th>
          </tr>
          <?php $counter1=-1;  if( isset($agressor) && ( is_array($agressor) || $agressor instanceof Traversable ) && sizeof($agressor) ) foreach( $agressor as $key1 => $value1 ){ $counter1++; ?>
          <tr>
            <td><?php echo htmlspecialchars( $value1["idOcorrenciaAgressor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
            <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
            <?php if( $value1["isCpf"] == '1' ){ ?>
            <td><?php echo htmlspecialchars( $value1["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
            <?php } ?>
            <?php if( $value1["isCpf"] == '0' ){ ?>
            <td><?php echo htmlspecialchars( $value1["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
            <?php } ?>
            <?php if( $value1["isInstituicao"] == '0' ){ ?>
            <td>Pessoa Física</td>
            <?php } ?>
            <?php if( $value1["isInstituicao"] == '1' ){ ?>
            <td>Instituição</td>
            <?php } ?>
            <?php if( $value1["isExcluido"] == '0' ){ ?>
            <td>Ativo</td>
            <?php } ?>
            <?php if( $value1["isExcluido"] == '1' ){ ?>
            <td>Excluido</td>
            <?php } ?>
            <td>
              <?php if( $value1["isExcluido"] == '1' ){ ?>
              <a href="/ocorrencia-agressor-detalhe/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["isInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrenciaAgressor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-bars"></i></a>
              <?php } ?>
              <?php if( $value1["isExcluido"] == '0' ){ ?>
              <a href="/ocorrencia-agressor-detalhe/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["isInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrenciaAgressor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-bars"></i></a>
              <a href="/ocorrencia-agressor-editar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["isInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrenciaAgressor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="/ocorrencia-agressor-excluir/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["isInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrenciaAgressor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>
        </table>
        <!--Fim Tabela-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->