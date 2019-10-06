<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detalhe da Ocorrência - Novo Responsável</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalhe da Ocorrência - Novo Responsável</li>
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
        <h3 class="box-title">Responsável</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="/ocorrencia-responsavel-vitima-cadastrar/{idVitima}/{idOcorrencia}" method="post">

          <!--Row-->
          <div class="row">
            <!--Nome do responsavel-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-responsavel">Nome Completo *</label>
                <input type="text" name="nomeResponsavel" id="id-nome-responsavel" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" required>
              </div>
            </div>
            <!--Fim Nome do vitima-->

            <!--Inicio Radio-->
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden" id="id-radio-pais-hidden-responsavel">
                <label>O que o responsavel é da Vítima?</label><br>
                <label class="container-radio">Pai
                  <input type="radio" name="responsavelRadio" id="id-responsavel-pai" class="minimal" value="1">
                  <span class="checkmark"></span>
                </label>
                <label class="container-radio">Mãe
                  <input type="radio" name="responsavelRadio" id="id-responsavel-mae" class="minimal" value="2">
                  <span class="checkmark"></span>
                </label>
                <label class="container-radio">Outro
                  <input type="radio" name="responsavelRadio" id="id-responsavel-outro" class="minimal" value="3">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <!--Fim Radio-->

            <!--Nome do vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-responsavel-text-outro" id="id-responsavel-label-outro">Outro</label>
                <input type="text" name="responsavelOutro" id="id-responsavel-text-outro" class="form-control" maxlength="40" onkeyup="validarCaracter(this, 1)">
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
                <label for="id-cpf-responsavel">CPF *</label>
                <input type="text" name="cpfResponsavel" id="id-cpf-responsavel" class="form-control" placeholder="___.___.___-__" required>
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-rg-responsavel">RG</label>
                <input type="text" name="rgResponsavel" id="id-rg-responsavel" class="form-control" placeholder="__.___.___" onblur="digitoRg()">
              </div>
            </div>
            <!--Fim RG-->

            <!--RG digito verificador-->
            <div class="col-md-1 divBordaVermelhaVerde">
              <div class="form-group">
                <label for="id-rg-digito-responsavel">Digito</label>
                <input type="text" name="rgDigitoResponsavel" id="id-rg-digito-responsavel" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)">
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
                    <input type="text" name="dataNascResponsavel" id="id-data-nasc-responsavel" class="form-control" placeholder="__/__/____">
                  </div>
                </div>
              </div>
              <!--Data de Nascimento da vitima-->

              <!--Sexo-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-sexo-responsavel">Sexo</label>
                  <select class="form-control select2" name="sexoResponsavel" id="id-sexo-responsavel">
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
                <label for="id-email-responsavel">E-mail</label>
                <input type="email" name="emailResponsavel" id="id-email-responsavel" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100">
              </div>
            </div>
            <!--Fim Email-->

            <!--Telefone Fixo vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-responsavel">Telefone Fixo</label>
                <input type="text" name="telFixoResponsavel" id="id-telfixo-responsavel" class="form-control" placeholder="____-____">
              </div>
            </div>
            <!--Telefone Fixo vitima-->

            <!--Celular vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-responsavel">Celular</label>
                <input type="text" name="celularResponsavel" id="id-celular-responsavel" class="form-control" placeholder="_____-____">
              </div>
            </div>
            <!--Fim Celular vitima-->
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
                <label for="id-cep-responsavel">CEP</label>
                <input type="text" name="cepResponsavel" id="id-cep-responsavel" class="form-control" placeholder="_____-___">
              </div>
            </div>
            <!--Fim Numero cep-->

            <!--Rua vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-rua-responsavel">Rua</label>
                <input type="text" name="ruaResponsavel" id="id-rua-responsavel" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">
              </div>
            </div>
            <!--Fim Rua vitima-->

            <!--Bairro vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-bairro-responsavel">Bairro</label>
                <input type="text" name="bairroResponsavel" id="id-bairro-responsavel" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">
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
                <label for="id-numero-responsavel">Numero</label>
                <input type="number" name="numeroResponsavel" id="id-numero-responsavel" class="form-control" placeholder="Numero da casa" min="0">
              </div>
            </div>
            <!--Fim Numero vitima--> 

            <!--Estado vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-estado-responsavel">Estado</label>
                <select class="form-control select2" name="estadoResponsavel" id="id-estado-responsavel">
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
                <label for="id-cidade-responsavel">Cidade</label>
                <input type="text" name="cidadeResponsavel" id="id-cidade-responsavel" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)">
              </div>
            </div>
            <!--Fim Cidade vitima-->

            <!--Complemento vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-responsavel">Complemento</label>
                <input type="text" name="complementoResponsavel" id="id-complemento-responsavel" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)">
              </div>
            </div>
            <!--Fim Complemento vitima-->
          </div>
          <!--Fim Row-->     

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

var inputOutro = document.getElementById('id-responsavel-text-outro');
var labelOutro = document.getElementById('id-responsavel-label-outro');

window.onload = function()
{
  let radioResponsavel = document.getElementById('id-radio-pais-hidden-responsavel').value;
  let responsavelPai = document.getElementById('id-responsavel-pai');
  let responsavelMae = document.getElementById('id-responsavel-mae');
  let responsavelOutro = document.getElementById('id-responsavel-outro');

  //isPais
  //1 = outro
  //2 = pai
  //3 = mae

  if (radioResponsavel == 1) {
    responsavelOutro.checked = true;
  }

  if (radioResponsavel == 2) {
    responsavelPai.checked = true;
  }

  if (radioResponsavel == 3) {
    responsavelMae.checked = true;
  }

  //////////////////////////////////////////////////////////////////////////////////////////////

  responsavelPai.onclick = mostra1;

  responsavelMae.onclick = mostra2;

  responsavelOutro.onclick = mostra3;

  inputOutro.classList.add("escondido");
  labelOutro.classList.add("escondido");
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

function mostra1()
{
  inputOutro.classList.add("escondido");
  labelOutro.classList.add("escondido");
}

function mostra2()
{
  inputOutro.classList.add("escondido");
  labelOutro.classList.add("escondido");
}

function mostra3()
{
  inputOutro.classList.remove("escondido");
  labelOutro.classList.remove("escondido");
}

</script>