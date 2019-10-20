<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Agressor Editar</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Agressor Editar</li>
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
        <form action="/ocorrencia-agressor-editar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $isInstituicao, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $agressor["0"]["idOcorrenciaAgressor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

          <div class="row">
            <div class="col-md-12">
              <?php if( $error != '' ){ ?>
              <div class="alert alert-danger">
                <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
              </div>
              <?php } ?>
            </div>
          </div>
          
          <!--Row-->
          <div class="row">
            <!--Nome do Agressor-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-agressor">Nome Completo do agressor *</label>
                <input type="text" name="nomeAgressor" id="id-nome-agressor" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $agressor["0"]["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim Nome do Agressor-->

            <!--Data de Nascimento da Agressor-->
              <div class="col-md-3">
                <div class="form-group">
                  <label>Data de Nascimento</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="dataNascAgressor" id="id-data-nasc-agressor" class="form-control" placeholder="__/__/____" value="<?php echo htmlspecialchars( $agressor["0"]["dataNasc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
              </div>
              <!--Data de Nascimento da Agressor-->

              <!--Sexo-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-sexo-hidden" value="<?php echo htmlspecialchars( $agressor["0"]["sexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <label for="id-sexo-agressor">Sexo</label>
                  <select class="form-control select2" name="sexoAgressor" id="id-sexo-agressor">
                    <option value="m">Masculino</option>
                    <option value="f">Feminino</option>
                  </select>
                </div>
              </div>
              <!--Fim Sexo-->
          </div>
          <!--Fim Row-->

          <!--Inicio row-->
          <div class="row">
            <!--CPF-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-cpf-agressor">CPF *</label>
                <input type="text" name="cpfAgressor" id="id-cpf-agressor" class="form-control" placeholder="___.___.___-__" value="<?php echo htmlspecialchars( $agressor["0"]["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-rg-agressor">RG</label>
                <input type="text" name="rgAgressor" id="id-rg-agressor" class="form-control" placeholder="__.___.___" onblur="digitoRg()" value="<?php echo htmlspecialchars( $agressor["0"]["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim RG-->

            <!--RG digito verificador-->
            <div class="col-md-1 divBordaVermelhaVerde">
              <div class="form-group">
                <label for="id-rg-digito-agressor">Digito</label>
                <input type="text" name="rgDigitoAgressor" id="id-rg-digito-agressor" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)" value="<?php echo htmlspecialchars( $agressor["0"]["rgDigito"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim RG digito verificador-->

            <!--Telefone Fixo Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-agressor">Telefone Fixo</label>
                <input type="text" name="telFixoAgressor" id="id-telfixo-agressor" class="form-control" placeholder="____-____" value="<?php echo htmlspecialchars( $agressor["0"]["fixo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Telefone Fixo Agressor-->

            <!--Celular Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-agressor">Celular</label>
                <input type="text" name="celularAgressor" id="id-celular-agressor" class="form-control" placeholder="_____-____" value="<?php echo htmlspecialchars( $agressor["0"]["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Celular Agressor-->
          </div>
          <!--Fim row-->

          <!--Email do Agressor-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-email-agressor">E-mail</label>
                <input type="email" name="emailAgressor" id="id-email-agressor" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100" value="<?php echo htmlspecialchars( $agressor["0"]["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
          </div>
          <!--Fim Email do Agressor-->

          <div class="row">
            <div class="col-md-12">
              <h4>Endereço do Usuário</h4>
              <hr>
            </div>
          </div>

          <br>

          <!--Inicio Row-->
          <div class="row">
            <!--Numero cep-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-cep-agressor">CEP</label>
                <input type="text" name="cepAgressor" id="id-cep-agressor" class="form-control" placeholder="_____-___" value="<?php echo htmlspecialchars( $agressor["0"]["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Numero cep-->

            <!--Rua Agressor-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-rua-agressor">Rua</label>
                <input type="text" name="ruaAgressor" id="id-rua-agressor" class="form-control" placeholder="Digite o nome da rua da Agressor" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $agressor["0"]["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Rua Agressor-->

            <!--Bairro Agressor-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-bairro-agressor">Bairro</label>
                <input type="text" name="bairroAgressor" id="id-bairro-agressor" class="form-control" placeholder="Digite o nome do bairro da Agressor" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $agressor["0"]["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Bairro Agressor-->
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
             <!--Numero Agressor-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-numero-agressor">Numero</label>
                <input type="number" name="numeroAgressor" id="id-numero-agressor" class="form-control" placeholder="Numero da casa" min="0" value="<?php echo htmlspecialchars( $agressor["0"]["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Numero Agressor--> 

            <!--Estado Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden" id="id-estado-hidden" value="<?php echo htmlspecialchars( $agressor["0"]["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <label for="id-estado-agressor">Estado</label>
                <select class="form-control select2" name="estadoAgressor" id="id-estado-agressor">
                  <option value="ac">Acre</option>
                  <option value="al">Alagoas</option>
                  <option value="ap">Amapá</option>
                  <option value="am">Amazonas</option>
                  <option value="ba">Bahia</option>
                  <option value="ce">Ceará</option>
                  <option value="df">Distrito Federal</option>
                  <option value="es">Espirito Santos</option>
                  <option value="go">Goiás</option>
                  <option value="ma">Maranhão</option>
                  <option value="mt">Mato Grosso</option>
                  <option value="ms">Mato Grosso do Sul</option>
                  <option value="mg">Minas Gerais</option>
                  <option value="pa">Pará</option>
                  <option value="pb">Paraíba</option>
                  <option value="pr">Paraná</option>
                  <option value="pe">Pernambuco</option>
                  <option value="pi">Piauí</option>
                  <option value="rj">Rio de Janeiro</option>
                  <option value="rn">Rio Grande do Norte</option>
                  <option value="rs">Rio Grande do Sul</option>
                  <option value="ro">Rondônia</option>
                  <option value="rr">Roraima</option>
                  <option value="sc">Santa Catarina</option>
                  <option value="sp" selected>São Paulo</option>
                  <option value="se">Sergipe</option>
                  <option value="to">Tocantins</option>
                </select>
              </div>
            </div>
            <!--Fim Estado Agressor-->

            <!--Cidade Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-cidade-agressor">Cidade</label>
                <input type="text" name="cidadeAgressor" id="id-cidade-agressor" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $agressor["0"]["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Cidade Agressor-->

            <!--Complemento Agressor-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-agressor">Complemento</label>
                <input type="text" name="complementoAgressor" id="id-complemento-agressor" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $agressor["0"]["complemento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Complemento Agressor-->
          </div>
          <!--Fim Row-->

          <br><hr><br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Editar">
            </div>            
          </div>
          <!--Fim Row-->
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

window.onload = function()
{
  let sexoHidden = document.getElementById("id-sexo-hidden").value;
  let estadoHidden = document.getElementById("id-estado-hidden").value;

  estadoHidden = estadoHidden.toLowerCase();

  let sexo = document.getElementById("id-sexo-agressor").value = sexoHidden;  
  let estado = document.getElementById("id-estado-agressor").value = estadoHidden;
}

function digitoRg()
{
  let rg = document.getElementById("id-rg-agressor");
  let digito = document.getElementById("id-rg-digito-agressor");

  if (rg.value != "") {
    if (digito.value == null || digito.value == "") {
      digito.classList.remove("borda-verde");
      digito.classList.add("borda-vermelha");
    } else {
      digito.classList.add("borda-verde");
      digito.classList.remove("borda-vermelha");
    }
  } else {
    digito.classList.remove("borda-verde");
    digito.classList.remove("borda-vermelha");
  }
}

</script>