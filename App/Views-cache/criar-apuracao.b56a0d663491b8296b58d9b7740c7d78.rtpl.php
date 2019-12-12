<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Criar Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Criar Apuração</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        
        <div class="row">
          <div class="col-md-12">
            <h3 class="titulo-h3">Dados da Apuração</h3>
          </div>
        </div>

        <hr>
        <br>

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Obrigatório adicionar a quantidade de famílias na ocorrência (1° Campo do formulário).
          <br>Quantidade de famílias varia quando for mais de uma vítima e elas não pertecerem ao mesmos pais ai no caso são duas familias e cada vitima relacionada a uma diferente.
        </div>

        <div class="row">
          <div class="col-md-12">
            <?php if( $error != '' ){ ?>
            <div class="alert alert-danger">
              <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
          </div>
        </div>

        <!--Inicio Form-->
        <form action="/criar-apuracao" method="post">

          <!--Quantidade de Familia-->
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <label for="id-qtd-familias">Quantas famílias são: *</label>
                  <input type="number" name="qtdFamilias" id="id-qtd-familias" class="form-control" step="1" min="0" onBlur="qtdFamilia(), validarEnivar()" required>
                </div>
              </div>
            </div>
            <!--Fim box-body -->
          </div>
          <!--Fim Box Dados da Ocorrencia-->

          <!--Adicionar vitimas-->
          <div id="dynamicDiv"></div>

          <a class="btn btn-default btn-block" href="javascript:void(0)" id="addInput" onBlur="qtdFamilia()">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Adicionar Vítima
          </a>

          <br>

          <!-------------------------------------------------------------->
          <!-------------------------------------------------------------->
          <!--              Box Dadados da Ocorrencia                   -->
          <!-------------------------------------------------------------->
          <!-------------------------------------------------------------->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dados da Apuração</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <!--Inicio Row-->
              <div class="row">
                <!--Tipo da Ocorrencia-->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id-tipo-da-ocorrencia">Tipo da Apuração *</label>
                    <input type="text" name="tipoApuracao" id="id-tipo-apuracao" class="form-control" maxlength="100" onkeyup="validarCaracter(this, 3)" onblur="validarEnivar()" required>
                  </div>
                </div>
                <!--Fim Tipo da Ocorrencia-->

                <!--Descricao da Ocorrencia-->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id-descricao-da-ocorrencia">Descrição da Apuração *</label>
                    <textarea name="descricaoApuracao" id="id-descricao-apuracao" class="form-control" rows="10" onblur="validarEnivar()" required></textarea>
                  </div>
                </div>
                <!--Fim Descricao da Ocorrencia-->            
              </div>
              <!--Fim Row-->
            </div>
            <!--Fim box-body -->
          </div>
          <!--Fim Box Dados da Ocorrencia-->

          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Enviar">
            </div>            
          </div>
          <!--Fim Row-->
        </form>
        <!--Fim Form-->

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
  let qtdFamilia = document.getElementById("id-qtd-familias");
  let tipoApuracao = document.getElementById("id-tipo-apuracao");
  let descricaoApuracao = document.getElementById("id-descricao-apuracao");
  
  if
  (
    qtdFamilia.value != "" &&
    tipoApuracao.value != "" &&
    descricaoApuracao.value != ""
  ){
    botaoEnviar.disabled = false;
  } else {
    botaoEnviar.setAttribute("disabled", false);
  }
}

function qtdFamilia()
{
  
  let qtdFamilias = document.getElementById('id-qtd-familias').value;

  let selectFamilia;

  let option;

  for (let aux = 1; aux <= 100; aux++) {
    selectFamilia = document.getElementById('id-qual-familia-vitima-'+aux+'');

    option = "";

    if (selectFamilia != null) {
      for (let i = 1; i <= qtdFamilias; i++) {
        option += "<option value='familia"+i+"'>Familia "+i+"</option>";
      }
      selectFamilia.innerHTML = option;
    }
  }

}
</script>