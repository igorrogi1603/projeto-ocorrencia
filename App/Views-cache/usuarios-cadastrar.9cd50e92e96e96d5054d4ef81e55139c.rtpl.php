<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Cadastrar Usuário</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Cadastrar Usuário</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Dados do Usuário</h3>
      </div>

      <!-- /.box-header -->
      <div class="box-body">

        <form action="/usuarios-cadastrar" method="post">
          <div class="row">
            <div class="col-md-12">
              <?php if( $error != '' ){ ?>
              <div class="alert alert-danger">
                <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="row">
            <!--Inicio Radio-->
            <div class="col-md-12">
              <div class="form-group">
                <label>Quem é o Usuário?</label><br>
                <label class="container-radio">Instituição
                  <input type="radio" name="radio" id="id-instituicao" class="minimal" value="1">
                  <span class="checkmark"></span>
                </label>
                <label class="container-radio">Pessoa Física
                  <input type="radio" name="radio" id="id-pessoa" class="minimal" value="2">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <!--Fim Radio-->
          </div>

          <hr><br>

          <div id="id-div-pessoa">
            <!--Row-->
            <div class="row">
              <!--Nome do usuario-->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id-nome-usuario">Nome Completo do Usuario *</label>
                  <input type="text" name="nomeUsuario" id="id-nome-usuario" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" onblur="confirmarSenha()" >
                </div>
              </div>
              <!--Fim Nome do usuario-->

              <!--Data de Nascimento da usuario-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Data de Nascimento</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="dataNascUsuario" id="id-data-nasc-usuario" class="form-control" placeholder="__/__/____">
                    </div>
                  </div>
                </div>
                <!--Data de Nascimento da usuario-->

                <!--Sexo-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-sexo-usuario">Sexo</label>
                    <select class="form-control select2" name="sexoUsuario" id="id-sexo-usuario">
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
                    <label for="id-cpf-usuario">CPF *</label>
                    <input type="text" name="cpfUsuario" id="id-cpf-usuario" class="form-control" placeholder="___.___.___-__" onblur="confirmarSenha()" >
                  </div>
                </div>
                <!--Fim CPF-->

                <!--RG-->
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="id-rg-usuario">RG</label>
                    <input type="text" name="rgUsuario" id="id-rg-usuario" class="form-control" placeholder="__.___.___" onblur="digitoRg()">
                  </div>
                </div>
                <!--Fim RG-->

                <!--RG digito verificador-->
                <div class="col-md-1 divBordaVermelhaVerde">
                  <div class="form-group">
                    <label for="id-rg-digito-usuario">Digito</label>
                    <input type="text" name="rgDigitoUsuario" id="id-rg-digito-usuario" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)">
                  </div>
                </div>
                <!--Fim RG digito verificador-->

                <!--Telefone Fixo usuario-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-telfixo-usuario">Telefone Fixo</label>
                    <input type="text" name="telFixoUsuario" id="id-telfixo-usuario" class="form-control" placeholder="____-____">
                  </div>
                </div>
                <!--Telefone Fixo usuario-->

                <!--Celular usuario-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-celular-usuario">Celular</label>
                    <input type="text" name="celularUsuario" id="id-celular-usuario" class="form-control" placeholder="_____-____">
                  </div>
                </div>
                <!--Fim Celular usuario-->
              </div>
              <!--Fim row-->

              <!--Inicio Row-->
              <div class="row">
                <!--Email do usuario-->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id-email-usuario">E-mail</label>
                    <input type="email" name="emailUsuario" id="id-email-usuario" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100">
                  </div>
                </div>
                <!--Fim Email do usuario-->

                <!--setor do usuario-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-setor-usuario">Setor *</label>
                    <select class="form-control select2" name="setorUsuario" id="id-setor-usuario" onblur="confirmarSenha()" >
                      <option value="Secretaria da Saude">Secretaria da Saúde</option>
                      <option value="Administração">Administração</option>
                    </select>
                  </div>
                </div>
                <!--Fim Setor do usuario-->

                <!--Funcao do usuario-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-funcao-usuario">Função *</label>
                    <input type="text" name="funcaoUsuario" id="id-funcao-usuario" class="form-control" placeholder="Função" maxlength="45"  onkeyup="validarCaracter(this, 1)" onblur="confirmarSenha()">
                  </div>
                </div>
                <!--Fim funcao do usuario-->
              </div>
              <!--Fim Row-->
            </div>
            <!--Fim Div Pessoa-->

            <div id="id-div-instituicao">
              <!--Row-->
              <div class="row">
                <!--Instituicao publica-->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Qual o tipo da instituição?</label><br>
                    <label class="container-radio">Instituição Pública
                      <input type="radio" name="radioQualInstituicao" id="id-instituicao-publica" class="minimal" value="1">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container-radio">Pessoa Jurídica
                      <input type="radio" name="radioQualInstituicao" id="id-pessoa-juridica" class="minimal" value="2" checked>
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
                <!--Fim Instituicao publica-->
              </div>
              <!--Fim Row-->

              <hr><br>

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

                <!--CNPJ-->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id-cnpj-instituicao">CNPJ *</label>
                    <input type="text" name="cnpjInstituicao" id="id-cnpj-instituicao" class="form-control" placeholder="___.___.___-__">
                  </div>
                </div>
                <!--Fim CNPJ-->
              </div>
              <!--Fim Row-->

              <div id="id-div-subnome-intituicao-publica">
                <!--Row-->
                <div class="row">
                  <!--Nome do agressor-->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="id-subnome-instituicao">Subnome da Instituição Pública</label>
                      <input type="text" name="subnomeInstituicao" id="id-subnome-instituicao" class="form-control" placeholder="Digite o subnome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)">
                    </div>
                  </div>
                  <!--Fim Nome do vitima-->
                </div>
                <!--Fim Row-->
              </div>

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
            </div>
            <!--Fim div Instituicao-->

            <div id="div-iguais">
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
                    <label for="id-cep-usuario">CEP</label>
                    <input type="text" name="cepUsuario" id="id-cep-usuario" class="form-control" placeholder="_____-___">
                  </div>
                </div>
                <!--Fim Numero cep-->

                <!--Rua usuario-->
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="id-rua-usuario">Rua</label>
                    <input type="text" name="ruaUsuario" id="id-rua-usuario" class="form-control" placeholder="Digite o nome da rua da usuario" maxlength="100" onkeyup="validarCaracter(this, 3)">
                  </div>
                </div>
                <!--Fim Rua usuario-->

                <!--Bairro usuario-->
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="id-bairro-usuario">Bairro</label>
                    <input type="text" name="bairroUsuario" id="id-bairro-usuario" class="form-control" placeholder="Digite o nome do bairro da usuario" maxlength="100" onkeyup="validarCaracter(this, 3)">
                  </div>
                </div>
                <!--Fim Bairro usuario-->
              </div>
              <!--Fim Row-->

              <!--Inicio Row-->
              <div class="row">
                 <!--Numero usuario-->
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="id-numero-usuario">Numero</label>
                    <input type="number" name="numeroUsuario" id="id-numero-usuario" class="form-control" placeholder="Numero da casa" min="0">
                  </div>
                </div>
                <!--Fim Numero usuario--> 

                <!--Estado usuario-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-estado-usuario">Estado</label>
                    <select class="form-control select2" name="estadoUsuario" id="id-estado-usuario">
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
                <!--Fim Estado usuario-->

                <!--Cidade usuario-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id-cidade-usuario">Cidade</label>
                    <input type="text" name="cidadeUsuario" id="id-cidade-usuario" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)">
                  </div>
                </div>
                <!--Fim Cidade usuario-->

                <!--Complemento usuario-->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id-complemento-usuario">Complemento</label>
                    <input type="text" name="complementoUsuario" id="id-complemento-usuario" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)">
                  </div>
                </div>
                <!--Fim Complemento usuario-->
              </div>
              <!--Fim Row-->

              <div class="row">
                <div class="col-md-12">
                  <h4>Login do Usuário</h4>
                  <hr>
                </div>
              </div>

              <br>

              <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
                <strong>Nivel de Acesso</strong><br>
                <strong>Nivel 1: </strong>Acesso apenas para criar uma apuração, mas não poderá ver-las depois, apenas criar.<br>
                <strong>Nivel 2: </strong>Acesso apenas para criar apuração e fazer solicitações.<br>
                <strong>Nivel 3: </strong>Acesso apenas para cadastrar e gerenciar usuários do seu departamento.<br>
                <strong>Nivel 4: </strong>Acesso apenas para concelheiros, para poder gerenciar as ocorrências.<br>
                <strong>Nivel 5: </strong>Acesso apenas para monitorar os servidores, para administrador de rede.
              </div>

              <!--Inicio Row-->
              <div class="row">
                <!--nivel de acesso do usuario-->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id-nivel-usuario">Nivel de Acesso *</label>
                    <select class="form-control select2" name="nivelUsuario" id="id-nivel-usuario" onblur="confirmarSenha()" required>
                      <option value="1">Nível 1</option>
                      <option value="2">Nível 2</option>
                      <option value="3">Nível 3</option>
                      <option value="4">Nível 4</option>
                      <option value="5">Nível 5</option>
                      <!--O acesso supremo não deixar para selecionar --REMOVER ESSE COMENTARIO DPS-- -->
                    </select>
                  </div>
                </div>
                <!--Fim nivel de acesso do usuario-->

                <!--Usuario-->
                <div class="col-md-6">
                  <label for="id-username-usuario">Usuário *</label>
                  <input type="text" name="usernameUsuario" id="id-username-usuario" class="form-control" placeholder="Usuário" maxlength="45" onblur="confirmarSenha()" onkeyup="validarCaracter(this, 2)" required>
                </div>
                <!--Fim Usuario-->
              </div>
              <!--Fim Row-->

              <!--Inicio Row-->
              <div class="row">
                <!--Senha-->
                <div class="col-md-6">
                  <label for="id-senha-usuario">Senha * </label>
                  <a data-teste="popover" data-toggle="popover" data-placement="right" data-trigger="hover" title="<strong>Informação</strong>" 
                    data-content="<strong>Senha deve conter:</strong><br>
                                  - Letras Maiúsculas<br>
                                  - Letras Minúsculas<br>
                                  - Um Simbúlo<br>
                                  - Um Número">
                    <i class="fa fa-question-circle"></i>
                  </a>
                  <input type="password" name="senhaUsuario" id="id-senha-usuario" class="form-control" placeholder="Senha" onblur="confirmarSenha()" required>
                </div>
                <!--Fim Senha-->
                
                <!--Confirmacao Senha-->
                <div class="col-md-6 divBordaVermelhaVerde">
                  <label for="id-confirmacao-senha-usuario">Confirmar Senha *</label>
                  <input type="password" name="confirmacaoSenhaUsuario" id="id-confirmacao-senha-usuario" class="form-control" placeholder="Confirmação da Senha" onblur="confirmarSenha()" required>
                  <span class="senha-incorreta esconder" id="id-senha-incorreta">Senhas não estão iguais</span>
                </div>
                <!--Fim Confirmacao Senha-->
              </div>
              <!--Fim Row-->

              <br><hr><br>

              <!--Inicio Row-->
              <div class="row">
                <div class="col-md-12">
                  <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Cadastrar">
                </div>            
              </div>
              <!--Fim Row-->
            </div>
            <!--Fim div-iguais-->
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

  let divAgressorInstituicao = document.getElementById('id-div-instituicao');
  let divAgressorPessoa = document.getElementById('id-div-pessoa');
  let divIguais = document.getElementById('div-iguais');
  let divSubNomeInstituicaoPublica = document.getElementById('id-div-subnome-intituicao-publica');

  window.onload = function()
  {
    let botaoEnviar = document.getElementById("botaoEnviar");
    let agressorInstituicao = document.getElementById('id-instituicao');
    let agressorPessoa = document.getElementById('id-pessoa');

    let instituicaoPublica = document.getElementById('id-instituicao-publica');
    let pessoaJuridica = document.getElementById('id-pessoa-juridica');

    botaoEnviar.setAttribute("disabled", false);

    //isAgressor
    //1 = instituicao
    //2 = pessoa

    agressorInstituicao.onclick = mostra1;

    agressorPessoa.onclick = mostra2;

    divAgressorInstituicao.classList.add("escondido");
    divAgressorPessoa.classList.add("escondido");
    divIguais.classList.add("escondido");

    instituicaoPublica.onclick = mostrarInstituicaoPublica;
    pessoaJuridica.onclick = mostrarPessoaJuridica;

    divSubNomeInstituicaoPublica.classList.add("escondido");
  }
 
  function confirmarSenha()
  {
    let nome = document.getElementById("id-nome-usuario");
    let cpf = document.getElementById("id-cpf-usuario");
    let setor = document.getElementById("id-setor-usuario");
    let funcao = document.getElementById("id-funcao-usuario");
    let senha = document.getElementById("id-senha-usuario");
    let confirmarSenha = document.getElementById("id-confirmacao-senha-usuario");
    let usuario = document.getElementById("id-username-usuario");
    let nivelAcesso = document.getElementById("id-nivel-usuario");
    let botaoEnviar = document.getElementById("botaoEnviar");
    let senhaIncorreta = document.getElementById("id-senha-incorreta");

    if (senha.value === confirmarSenha.value && senha.value != "" && confirmarSenha != "") {
      confirmarSenha.classList.remove("borda-vermelha");
      confirmarSenha.classList.add("borda-verde");

      senhaIncorreta.classList.add("esconder");

      if ( 
          senha.value != "" && 
          confirmarSenha.value != "" && 
          usuario.value != "" && 
          nivelAcesso.value != ""
        ) 
      {
        botaoEnviar.disabled = false;
      }

    } else if (senha.value == "") {
      confirmarSenha.classList.remove("borda-verde");
      confirmarSenha.classList.remove("borda-vermelha");
      senhaIncorreta.classList.add("esconder");
    }else {
      confirmarSenha.classList.remove("borda-verde");
      confirmarSenha.classList.add("borda-vermelha");

      senhaIncorreta.classList.remove("esconder");

      botaoEnviar.setAttribute("disabled", false);
    }
  }

  function digitoRg()
  {
    let nome = document.getElementById("id-nome-usuario");
    let cpf = document.getElementById("id-cpf-usuario");
    let setor = document.getElementById("id-setor-usuario");
    let funcao = document.getElementById("id-funcao-usuario");
    let senha = document.getElementById("id-senha-usuario");
    let confirmarSenha = document.getElementById("id-confirmacao-senha-usuario");
    let usuario = document.getElementById("id-username-usuario");
    let nivelAcesso = document.getElementById("id-nivel-usuario");
    let rg = document.getElementById("id-rg-usuario");
    let digito = document.getElementById("id-rg-digito-usuario");
    let botaoEnviar = document.getElementById("botaoEnviar");

    if (rg.value != "") {
      if (digito.value == null || digito.value == "") {
        digito.classList.remove("borda-verde");
        digito.classList.add("borda-vermelha");
        
        botaoEnviar.setAttribute("disabled", false);
      } else {
        digito.classList.add("borda-verde");
        digito.classList.remove("borda-vermelha");

        if ( 
          senha.value != "" && 
          confirmarSenha.value != "" && 
          usuario.value != "" && 
          nivelAcesso.value != ""
        ) 
        {
          botaoEnviar.disabled = false;
        }
      }
    } else {
      digito.classList.remove("borda-verde");
      digito.classList.remove("borda-vermelha");

      if ( 
          senha.value != "" && 
          confirmarSenha.value != "" && 
          usuario.value != "" && 
          nivelAcesso.value != ""
        ) 
        {
          botaoEnviar.disabled = false;
        }
    }
  }

  function mostra1()
  {
    divAgressorInstituicao.classList.remove("escondido");
    divAgressorPessoa.classList.add("escondido");
    divIguais.classList.remove("escondido");
  }

  function mostra2()
  {
    divAgressorInstituicao.classList.add("escondido");
    divAgressorPessoa.classList.remove("escondido");
    divIguais.classList.remove("escondido");
  }

  function mostrarPessoaJuridica()
  {
    divSubNomeInstituicaoPublica.classList.add("escondido");
  }

  function mostrarInstituicaoPublica()
  {
    divSubNomeInstituicaoPublica.classList.remove("escondido");
  }

</script>