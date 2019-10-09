<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Lista de Documentos</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Lista de Documentos</li>
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
            <a href="/ocorrencia-vitima-enviar-arquivo-cadastrar/<?php echo htmlspecialchars( $idVitima, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success">Novo Documento</a>
          </div>          
        </div>
        <!--Fim Row-->

        <!--Tabela-->
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Opções</th>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <a href="/ocorrencia-vitimas/" class="btn btn-primary"><i class="fa fa-eye"></i></a>
              <a onclick="confirmar()" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          <script>
            function confirmar()
            {
              if(confirm("Voce realmente deseja EXCLUIR esse documento?")){
                location.href="/ocorrencia-responsavel-vitima-excluir/";
              }
            }
          </script>
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