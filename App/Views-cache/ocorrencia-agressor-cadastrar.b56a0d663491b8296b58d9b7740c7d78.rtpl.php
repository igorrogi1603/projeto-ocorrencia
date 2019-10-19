<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Novo Agressor</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Novo Agressor</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <?php if( $error != '' ){ ?>
        <div class="alert alert-danger">
          <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>
      </div>
    </div>

    <!--Box Detalhes-->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Agressor</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="/ocorrencia-agressor-cadastrar/<?php echo htmlspecialchars( $idOcorrencia, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

          <div class="row">
            <!--Inicio Radio-->
            <div class="col-md-12">
              <div class="form-group">
                <label>Quem é o agressor?</label><br>
                <label class="container-radio">Instituição
                  <input type="radio" name="agressorRadio" id="id-agressor-instituicao" class="minimal" value="1">
                  <span class="checkmark"></span>
                </label>
                <label class="container-radio">Pessoa Física
                  <input type="radio" name="agressorRadio" id="id-agressor-pessoa" class="minimal" value="2">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <!--Fim Radio-->
          </div>

          <br><hr><br>

          <!--Inicio Div Pessoa-->
          <div id="id-div-agressor-pessoa">
            <!--Row-->
            <div class="row">
              <!--Nome do agressor-->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="id-nome-agressor">Nome Completo do Agressor *</label>
                  <input type="text" name="nomeAgressor" id="id-nome-agressor" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)">
                </div>
              </div>
              <!--Fim Nome do vitima-->
            </div>
            <!--Fim Row-->

            <!--Inicio row-->
            <div class="row">
              <!--CPF-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-cpf-agressor">CPF *</label>
                  <input type="text" name="cpfAgressor" id="id-cpf-agressor" class="form-control" placeholder="___.___.___-__">
                </div>
              </div>
              <!--Fim CPF-->

              <!--RG-->
              <div class="col-md-2">
                <div class="form-group">
                  <label for="id-rg-agressor">RG</label>
                  <input type="text" name="rgAgressor" id="id-rg-agressor" class="form-control" placeholder="__.___.___" onblur="digitoRg()">
                </div>
              </div>
              <!--Fim RG-->

              <!--RG digito verificador-->
              <div class="col-md-1 divBordaVermelhaVerde">
                <div class="form-group">
                  <label for="id-rg-digito-agressor">Digito</label>
                  <input type="text" name="rgDigitoAgressor" id="id-rg-digito-agressor" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)">
                </div>
              </div>
              <!--Fim RG digito verificador-->

              <!--Data de Nascimento da vitima-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Data de Nascimento</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="dataNascAgressor" id="id-data-nasc-agressor" class="form-control" placeholder="__/__/____">
                    </div>
                  </div>
                </div>
                <!--Data de Nascimento da vitima-->

                <!--Sexo-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-sexo-agressor">Sexo</label>
                    <select class="form-control select2" name="sexoAgressor" id="id-sexo-agressor">
                      <option value="m">Masculino</option>
                      <option value="f">Feminino</option>
                    </select>
                  </div>
                </div>
                <!--Fim Sexo-->
            </div>
            <!--Fim row-->

            <!--Email do vitima-->
            <div class="row">
              <!--Inicio Email-->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id-email-agressor">E-mail</label>
                  <input type="email" name="emailAgressor" id="id-email-agressor" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100">
                </div>
              </div>
              <!--Fim Email-->

              <!--Telefone Fixo vitima-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-telfixo-agressor">Telefone Fixo</label>
                  <input type="text" name="telFixoAgressor" id="id-telfixo-agressor" class="form-control" placeholder="____-____">
                </div>
              </div>
              <!--Telefone Fixo vitima-->

              <!--Celular vitima-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-celular-agressor">Celular</label>
                  <input type="text" name="celularAgressor" id="id-celular-agressor" class="form-control" placeholder="_____-____">
                </div>
              </div>
              <!--Fim Celular vitima-->
            </div>
            <!--Fim Email do vitima-->

            <div class="row">
              <div class="col-md-12">
                <h4>Endereço do Agressor</h4>
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
                  <input type="text" name="cepAgressor" id="id-cep-agressor" class="form-control" placeholder="_____-___">
                </div>
              </div>
              <!--Fim Numero cep-->

              <!--Rua vitima-->
              <div class="col-md-5">
                <div class="form-group">
                  <label for="id-rua-agressor">Rua</label>
                  <input type="text" name="ruaAgressor" id="id-rua-agressor" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">
                </div>
              </div>
              <!--Fim Rua vitima-->

              <!--Bairro vitima-->
              <div class="col-md-5">
                <div class="form-group">
                  <label for="id-bairro-agressor">Bairro</label>
                  <input type="text" name="bairroAgressor" id="id-bairro-agressor" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">
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
                  <label for="id-numero-agressor">Numero</label>
                  <input type="number" name="numeroAgressor" id="id-numero-agressor" class="form-control" placeholder="Numero da casa" min="0">
                </div>
              </div>
              <!--Fim Numero vitima--> 

              <!--Estado vitima-->
              <div class="col-md-3">
                <div class="form-group">
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
              <!--Fim Estado vitima-->

              <!--Cidade vitima-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-cidade-agressor">Cidade</label>
                  <input type="text" name="cidadeAgressor" id="id-cidade-agressor" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)">
                </div>
              </div>
              <!--Fim Cidade vitima-->

              <!--Complemento vitima-->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="id-complemento-agressor">Complemento</label>
                  <input type="text" name="complementoAgressor" id="id-complemento-agressor" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)">
                </div>
              </div>
              <!--Fim Complemento vitima-->
            </div>
            <!--Fim Row-->
          </div>
          <!--Fim div pessoa-->  

          <!-------------------------------------------------------------------------------------->
          <!-------------------------------------------------------------------------------------->
          <!-------------------------------------------------------------------------------------->
          <!-------------------------------------------------------------------------------------->
          <!-------------------------------------------------------------------------------------->

          <!--Inicio div instituicao-->   
          <div id="id-div-agressor-instituicao">
            <!--Row-->
            <div class="row">
              <!--Nome do agressor-->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id-nome-instituicao">Nome Completo da Instituição *</label>
                  <input type="text" name="nomeInstituicao" id="id-nome-instituicao" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)">
                </div>
              </div>
              <!--Fim Nome do vitima-->

              <!--CPF-->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id-cnpj-instituicao">CNPJ *</label>
                  <input type="text" name="cnpjInstituicao" id="id-cnpj-instituicao" class="form-control" placeholder="___.___.___-__">
                </div>
              </div>
              <!--Fim CPF-->
            </div>
            <!--Fim Row-->

            <!--Email do vitima-->
            <div class="row">
              <!--Inicio Email-->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id-email-instituicao">E-mail</label>
                  <input type="email" name="emailInstituicao" id="id-email-instituicao" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100">
                </div>
              </div>
              <!--Fim Email-->

              <!--Telefone Fixo vitima-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-telfixo-instituicao">Telefone Fixo</label>
                  <input type="text" name="telFixoInstituicao" id="id-telfixo-instituicao" class="form-control" placeholder="____-____">
                </div>
              </div>
              <!--Telefone Fixo vitima-->

              <!--Celular vitima-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-celular-instituicao">Celular</label>
                  <input type="text" name="celularInstituicao" id="id-celular-instituicao" class="form-control" placeholder="_____-____">
                </div>
              </div>
              <!--Fim Celular vitima-->
            </div>
            <!--Fim Email do vitima-->

            <div class="row">
              <div class="col-md-12">
                <h4>Endereço do Instituicao</h4>
                <hr>
              </div>
            </div>

            <br>

            <!--Inicio Row-->
            <div class="row">
              <!--Numero cep-->
              <div class="col-md-2">
                <div class="form-group">
                  <label for="id-cep-instituicao">CEP</label>
                  <input type="text" name="cepInstituicao" id="id-cep-instituicao" class="form-control" placeholder="_____-___">
                </div>
              </div>
              <!--Fim Numero cep-->

              <!--Rua vitima-->
              <div class="col-md-5">
                <div class="form-group">
                  <label for="id-rua-instituicao">Rua</label>
                  <input type="text" name="ruaInstituicao" id="id-rua-instituicao" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">
                </div>
              </div>
              <!--Fim Rua vitima-->

              <!--Bairro vitima-->
              <div class="col-md-5">
                <div class="form-group">
                  <label for="id-bairro-instituicao">Bairro</label>
                  <input type="text" name="bairroInstituicao" id="id-bairro-instituicao" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">
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
                  <label for="id-numero-instituicao">Numero</label>
                  <input type="number" name="numeroInstituicao" id="id-numero-instituicao" class="form-control" placeholder="Numero da casa" min="0">
                </div>
              </div>
              <!--Fim Numero vitima--> 

              <!--Estado vitima-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-estado-instituicao">Estado</label>
                  <select class="form-control select2" name="estadoInstituicao" id="id-estado-instituicao">
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
                  <label for="id-cidade-instituicao">Cidade</label>
                  <input type="text" name="cidadeInstituicao" id="id-cidade-instituicao" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)">
                </div>
              </div>
              <!--Fim Cidade vitima-->

              <!--Complemento vitima-->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="id-complemento-instituicao">Complemento</label>
                  <input type="text" name="complementoInstituicao" id="id-complemento-instituicao" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)">
                </div>
              </div>
              <!--Fim Complemento vitima-->
            </div>
            <!--Fim Row-->
          </div>
          <!--Fim div instituicao-->   

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Salvar">
            </div>            
          </div>
          <!--Fim Row-->
        </form>
        <!--Fim form-->     
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

let divAgressorInstituicao = document.getElementById('id-div-agressor-instituicao');
let divAgressorPessoa = document.getElementById('id-div-agressor-pessoa');

window.onload = function()
{
  let agressorInstituicao = document.getElementById('id-agressor-instituicao');
  let agressorPessoa = document.getElementById('id-agressor-pessoa');

  //isAgressor
  //1 = instituicao
  //2 = pessoa

  agressorInstituicao.onclick = mostra1;

  agressorPessoa.onclick = mostra2;

  divAgressorInstituicao.classList.add("escondido");
  divAgressorPessoa.classList.add("escondido");
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

function mostra1()
{
  divAgressorInstituicao.classList.remove("escondido");
  divAgressorPessoa.classList.add("escondido");
}

function mostra2()
{
  divAgressorInstituicao.classList.add("escondido");
  divAgressorPessoa.classList.remove("escondido");
}

</script>