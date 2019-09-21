<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Descartar Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Descartar Apuração</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Relatótio de Exclusão da Apuração com <strong>id: <?php echo htmlspecialchars( $idApuracao, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></h3>
      </div>

      <!-- /.box-header -->
      <div class="box-body">

        <form action="/confirmacao-detalhe/descartar/<?php echo htmlspecialchars( $idApuracao, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $idConfirmacao, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          
          <!--Inicio row-->
          <div class="row">
            <!--Descricao da Ocorrencia-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-descricao-da-ocorrencia">Descrição do porque está excluindo a apuração *</label>
                <textarea name="descricaoApuracao" id="id-descricao-apuracao" class="form-control" rows="10" onblur="validarEnivar()" required></textarea>
              </div>
            </div>
            <!--Fim Descricao da Ocorrencia-->
          </div>
          <!--Fim row-->

          <div class="row">
            <div class="col-md-12">
              <label>
              <input type="checkbox" id="id-concordo" name="concordo" onblur="validarEnivar()">
              Concordo com os 
              <a href="#" class="" data-toggle="modal" data-target="#myModal">
                Termos de Responsabilidade
              </a>
              </label>
            </div>
          </div>          

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Termo de Responsabilidade</h4>
                </div>
                <div class="modal-body">
                  Aqui fica o termo de responssabilidade pedir ajuda a giovanna para criar esse termo onde diz que o usuario se responssabiliza pela exclusao por tudo que faz no sistema.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          
          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <a href="/confirmacao-detalhe/cancelar/<?php echo htmlspecialchars( $idApuracao, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $idConfirmacao, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left margin" id="botaoCancelar">Cancelar</a>
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Enviar">
            </div>            
          </div>
          <!--Fim Row-->

        </form>

      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

window.onload = function()
{
  let botaoEnviar = document.getElementById("botaoEnviar");

  botaoEnviar.setAttribute("disabled", false);
}

function validarEnivar()
{
  let botaoEnviar = document.getElementById("botaoEnviar");
  let concordo = document.getElementById("id-concordo");
  let descricaoApuracao = document.getElementById("id-descricao-apuracao");
  
  if
  (
    concordo.checked != false &&
    descricaoApuracao.value != ""
  ){
    botaoEnviar.disabled = false;
  } else {
    botaoEnviar.setAttribute("disabled", false);
  }
}

</script>
