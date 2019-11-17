<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Lista de Responsáveis</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Lista de Responsáveis</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Responsáveis</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <!--Row-->
        <div class="row">
          <div class="col-md-12">
            <a href="/ocorrencia-responsavel-vitima-cadastrar/<?php echo htmlspecialchars( $responsavel["0"]["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $responsavel["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success">Novo Responsavel</a>
            <a href="/ocorrencia-vitimas/<?php echo htmlspecialchars( $responsavel["0"]["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $responsavel["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary">Voltar</a>
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
              <th>CPF</th>
              <th>Opções</th>
            </tr>
            <?php $counter1=-1;  if( isset($responsavel) && ( is_array($responsavel) || $responsavel instanceof Traversable ) && sizeof($responsavel) ) foreach( $responsavel as $key1 => $value1 ){ $counter1++; ?>
            <?php if( $value1["isAindaResponsavel"] == 1 ){ ?>
            <tr>
              <td><?php echo htmlspecialchars( $value1["idPessoaResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["nomeResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["cpfResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td>
                <a href="/ocorrencia-responsavel-vitima-detalhe/<?php echo htmlspecialchars( $value1["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idPessoaResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default"><i class="fa fa-bars"></i></a>
                <a href="/ocorrencia-responsavel-vitima-editar/<?php echo htmlspecialchars( $value1["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idPessoaResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a onclick="confirmar()" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <?php } ?>
            <script>
              function confirmar()
              {
                if(confirm("Voce realmente deseja EXCLUIR esse responsável?")){
                  location.href="/ocorrencia-responsavel-vitima-excluir/<?php echo htmlspecialchars( $value1["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idPessoaResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
                }
              }
            </script>
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