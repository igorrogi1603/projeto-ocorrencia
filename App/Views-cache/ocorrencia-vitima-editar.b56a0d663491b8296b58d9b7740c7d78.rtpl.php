<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Vítimas Editar</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Vítimas Editar</li>
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
        <form action="/ocorrencia-vitima-editar/<?php echo htmlspecialchars( $vitima["0"]["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $vitima["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $vitima["0"]["idPessoaVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

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
            <!--Nome do vitima-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-vitima">Nome Completo da Vítima *</label>
                <input type="text" name="nomeVitima" id="id-nome-vitima" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $vitima["0"]["nomeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim Nome do vitima-->

            <!--Data de Nascimento da vitima-->
              <div class="col-md-3">
                <div class="form-group">
                  <label>Data de Nascimento</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="dataNascVitima" id="id-data-nasc-vitima" class="form-control" placeholder="__/__/____" value="<?php echo htmlspecialchars( $vitima["0"]["dataNascVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
              </div>
              <!--Data de Nascimento da vitima-->

              <!--Sexo-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-sexo-hidden" value="<?php echo htmlspecialchars( $vitima["0"]["sexoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <label for="id-sexo-vitima">Sexo</label>
                  <select class="form-control select2" name="sexoVitima" id="id-sexo-vitima">
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
                <label for="id-cpf-vitima">CPF *</label>
                <input type="text" name="cpfVitima" id="id-cpf-vitima" class="form-control" placeholder="___.___.___-__" value="<?php echo htmlspecialchars( $vitima["0"]["cpfVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-rg-vitima">RG</label>
                <input type="text" name="rgVitima" id="id-rg-vitima" class="form-control" placeholder="__.___.___" onblur="digitoRg()" value="<?php echo htmlspecialchars( $vitima["0"]["rgVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim RG-->

            <!--RG digito verificador-->
            <div class="col-md-1 divBordaVermelhaVerde">
              <div class="form-group">
                <label for="id-rg-digito-vitima">Digito</label>
                <input type="text" name="rgDigitoVitima" id="id-rg-digito-vitima" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)" value="<?php echo htmlspecialchars( $vitima["0"]["rgVitimaDigito"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim RG digito verificador-->

            <!--Telefone Fixo vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-vitima">Telefone Fixo</label>
                <input type="text" name="telFixoVitima" id="id-telfixo-vitima" class="form-control" placeholder="____-____" value="<?php echo htmlspecialchars( $vitima["0"]["fixoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Telefone Fixo vitima-->

            <!--Celular vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-vitima">Celular</label>
                <input type="text" name="celularVitima" id="id-celular-vitima" class="form-control" placeholder="_____-____" value="<?php echo htmlspecialchars( $vitima["0"]["celularVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Celular vitima-->
          </div>
          <!--Fim row-->

          <!--Email do vitima-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-email-vitima">E-mail</label>
                <input type="email" name="emailVitima" id="id-email-vitima" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100" value="<?php echo htmlspecialchars( $vitima["0"]["emailVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
          </div>
          <!--Fim Email do vitima-->

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
                <label for="id-cep-vitima">CEP</label>
                <input type="text" name="cepVitima" id="id-cep-vitima" class="form-control" placeholder="_____-___" value="<?php echo htmlspecialchars( $vitima["0"]["cepVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Numero cep-->

            <!--Rua vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-rua-vitima">Rua</label>
                <input type="text" name="ruaVitima" id="id-rua-vitima" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $vitima["0"]["ruaVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Rua vitima-->

            <!--Bairro vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-bairro-vitima">Bairro</label>
                <input type="text" name="bairroVitima" id="id-bairro-vitima" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $vitima["0"]["bairroVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Bairro vitima-->
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
             <!--Numero vitima-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-numero-vitima">Numero</label>
                <input type="number" name="numeroVitima" id="id-numero-vitima" class="form-control" placeholder="Numero da casa" min="0" value="<?php echo htmlspecialchars( $vitima["0"]["numeroVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Numero vitima--> 

            <!--Estado vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden" id="id-estado-hidden" value="<?php echo htmlspecialchars( $vitima["0"]["estadoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <label for="id-estado-vitima">Estado</label>
                <select class="form-control select2" name="estadoVitima" id="id-estado-vitima">
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
            <!--Fim Estado vitima-->

            <!--Cidade vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-cidade-vitima">Cidade</label>
                <input type="text" name="cidadeVitima" id="id-cidade-vitima" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $vitima["0"]["cidadeVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Cidade vitima-->

            <!--Complemento vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-vitima">Complemento</label>
                <input type="text" name="complementoVitima" id="id-complemento-vitima" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $vitima["0"]["complementoVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Complemento vitima-->
          </div>
          <!--Fim Row-->

          <br><hr><br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Editar">
              <a href="/ocorrencia-vitimas/<?php echo htmlspecialchars( $vitima["0"]["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $vitima["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left margin">Voltar</a> 
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

  let sexo = document.getElementById("id-sexo-vitima").value = sexoHidden;  
  let estado = document.getElementById("id-estado-vitima").value = estadoHidden;
}

function digitoRg()
{
  let rg = document.getElementById("id-rg-vitima");
  let digito = document.getElementById("id-rg-digito-vitima");

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