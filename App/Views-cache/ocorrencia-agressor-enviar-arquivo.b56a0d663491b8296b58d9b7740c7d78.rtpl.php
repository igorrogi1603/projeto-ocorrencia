<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ocorrência Agressor - Lista de Documentos</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ocorrência Agressor - Lista de Documentos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <!--Row-->
        <div class="row">
          <div class="col-md-12">
            <a href="/ocorrencia-agressor-enviar-arquivo-cadastrar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success">Novo Documento</a>
            <a href="/ocorrencia-agressor/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary">Voltar</a>
          </div>          
        </div>
        <!--Fim Row-->

        <br>

        <div style="overflow: auto; width: 100%; height: 100%;">
          <!--Tabela-->
          <table class="table table-hover">
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Tipo</th>
              <th>Pessoa Física / Instituição</th>
              <th>Opções</th>
            </tr>
            <?php $counter1=-1;  if( isset($documento) && ( is_array($documento) || $documento instanceof Traversable ) && sizeof($documento) ) foreach( $documento as $key1 => $value1 ){ $counter1++; ?>
            <?php if( $value1["status"] == 0 ){ ?>

            <?php if( $value1["tipo"] == 'cpf' ){ ?>
              <?php $varTipo = 1; ?>
            <?php } ?>
            <?php if( $value1["tipo"] == 'rg' ){ ?>
              <?php $varTipo = 2; ?>
            <?php } ?>
            <?php if( $value1["tipo"] == 'cnh' ){ ?>
              <?php $varTipo = 3; ?>
            <?php } ?>
            <?php if( $value1["tipo"] == 'cn' ){ ?>
              <?php $varTipo = 4; ?>
            <?php } ?>
            <?php if( $value1["tipo"] == 'cnpj' ){ ?>
              <?php $varTipo = 5; ?>
            <?php } ?>

            <?php if( $value1["isInstituicao"] == 0 ){ ?>
            <tr>
              <td><?php echo htmlspecialchars( $value1["idArquivosPessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <?php if( $value1["tipo"] == 'cn' ){ ?>
              <td>Certidão de Nascimento</td>
              <?php }else{ ?>
              <td><?php echo htmlspecialchars( $value1["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <?php } ?>
              <td>Pessoa Física</td>
              <td>
                <a href="<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                <a href="/ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idPessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idArquivosPessoa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $varTipo, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success"><i class="fa fa-refresh"></i></a>
              </td>
            </tr>
            <?php } ?>

            <?php if( $value1["isInstituicao"] == 1 ){ ?>
            <tr>
              <td><?php echo htmlspecialchars( $value1["idArquivosInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <?php if( $value1["tipo"] == 'cn' ){ ?>
              <td>Certidão de Nascimento</td>
              <?php }else{ ?>
              <td><?php echo htmlspecialchars( $value1["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <?php } ?>
              <td>Instituição</td>
              <td>
                <a href="<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                <a href="/ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idArquivosInstituicao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $varTipo, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success"><i class="fa fa-refresh"></i></a>
              </td>
            </tr>
            <?php } ?>

            <?php } ?>
            <?php } ?>
          </table>
          <!--Fim Tabela-->
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->