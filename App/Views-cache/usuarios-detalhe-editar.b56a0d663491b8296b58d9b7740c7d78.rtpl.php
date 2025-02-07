<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Editar Usuário</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Editar Usuário</li>
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

        <form action="/usuarios-detalhe/editar/<?php echo htmlspecialchars( $dadosUsuario["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

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
            <!--Nome do usuario-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-usuario">Nome Completo do Usuario *</label>
                <input type="text" name="nomeUsuario" id="id-nome-usuario" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" onblur="digitoRg()" value="<?php echo htmlspecialchars( $dadosUsuario["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim Nome do usuario-->

            <?php if( $dadosUsuario["isPessoa"] == 0 ){ ?>
            <!--CPF-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-cnpj-instituicao">CNPJ *</label>
                <input type="text" name="cnpjInstituicao" id="id-cnpj-instituicao" class="form-control" placeholder="___.___.___-__" onblur="digitoRg()" value="<?php echo htmlspecialchars( $dadosUsuario["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim CPF-->
            <?php } ?>

            <?php if( $dadosUsuario["isPessoa"] == 1 ){ ?>
            <!--Data de Nascimento da usuario-->
              <div class="col-md-3">
                <div class="form-group">
                  <label>Data de Nascimento</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="dataNascUsuario" id="id-data-nasc-usuario" class="form-control" placeholder="__/__/____" value="<?php echo htmlspecialchars( $dadosUsuario["dataNasc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
              </div>
              <!--Data de Nascimento da usuario-->

              <!--Sexo-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-sexo-hidden" value="<?php echo htmlspecialchars( $dadosUsuario["sexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <label for="id-sexo-usuario">Sexo</label>
                  <select class="form-control select2" name="sexoUsuario" id="id-sexo-usuario">
                    <option value="m">Masculino</option>
                    <option value="f">Feminino</option>
                  </select>
                  <input type="hidden" id="id-sexo-escondido" value="<?php echo htmlspecialchars( $dadosUsuario["sexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim Sexo-->
              <?php } ?>
          </div>
          <!--Fim Row-->

          <?php if( $dadosUsuario["isPessoa"] == 0 ){ ?>
            <?php if( $dadosUsuario["status"] == 1 ){ ?>
            <!--Row-->
            <div class="row">
              <!--Subnome-->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="id-subnome-usuario">Subnome da Instituição Pública</label>
                  <input type="text" name="subnomeUsuario" id="id-subnome-usuario" class="form-control" placeholder="Digite o subnome aqui" maxlength="70" value="<?php echo htmlspecialchars( $dadosUsuario["subnome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onkeyup="validarCaracter(this, 1)">
                </div>
              </div>
              <!--Fim subnome-->
            </div>
            <!--Fim Row-->
            <?php } ?>
          <?php } ?>

          <!--Se e instituicao publica ou pessoa juridica-->
          <input type="hidden" name="hiddenStatusUsuario" value="<?php echo htmlspecialchars( $dadosUsuario["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          
          <!--Inicio row-->
            <div class="row">
            <?php if( $dadosUsuario["isPessoa"] == 1 ){ ?>
              <!--CPF-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-cpf-usuario">CPF *</label>
                  <input type="text" name="cpfUsuario" id="id-cpf-usuario" class="form-control" placeholder="___.___.___-__" onblur="digitoRg()" value="<?php echo htmlspecialchars( $dadosUsuario["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <!--Fim CPF-->

              <!--RG-->
              <div class="col-md-2">
                <div class="form-group">
                  <label for="id-rg-usuario">RG</label>
                  <input type="text" name="rgUsuario" id="id-rg-usuario" class="form-control" placeholder="__.___.___" onblur="digitoRg()" value="<?php echo htmlspecialchars( $dadosUsuario["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim RG-->

              <!--RG digito verificador-->
              <div class="col-md-1 divBordaVermelhaVerde">
                <div class="form-group">
                  <label for="id-rg-digito-usuario">Digito</label>
                  <input type="text" name="rgDigitoUsuario" id="id-rg-digito-usuario" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)" value="<?php echo htmlspecialchars( $dadosUsuario["digitoRg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim RG digito verificador-->
              <?php } ?>

              <!--Telefone Fixo usuario-->
              <?php if( $dadosUsuario["isPessoa"] == 1 ){ ?>
              <div class="col-md-3">
              <?php } ?>
              <?php if( $dadosUsuario["isPessoa"] == 0 ){ ?>
              <div class="col-md-6">
              <?php } ?>
                <div class="form-group">
                  <label for="id-telfixo-usuario">Telefone Fixo</label>
                  <input type="text" name="telFixoUsuario" id="id-telfixo-usuario" class="form-control" placeholder="____-____" value="<?php echo htmlspecialchars( $dadosUsuario["fixo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Telefone Fixo usuario-->

              <!--Celular usuario-->
              <?php if( $dadosUsuario["isPessoa"] == 1 ){ ?>
              <div class="col-md-3">
              <?php } ?>
              <?php if( $dadosUsuario["isPessoa"] == 0 ){ ?>
              <div class="col-md-6">
              <?php } ?>
                <div class="form-group">
                  <label for="id-celular-usuario">Celular</label>
                  <input type="text" name="celularUsuario" id="id-celular-usuario" class="form-control" placeholder="_____-____" value="<?php echo htmlspecialchars( $dadosUsuario["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim Celular usuario-->
            </div>
            <!--Fim row-->

            <!--Inicio Row-->
            <div class="row">
              <!--Email do usuario-->
              <?php if( $dadosUsuario["isPessoa"] == 1 ){ ?>
              <div class="col-md-6">
              <?php } ?>
              <?php if( $dadosUsuario["isPessoa"] == 0 ){ ?>
              <div class="col-md-12">
              <?php } ?>
                <div class="form-group">
                  <label for="id-email-usuario">E-mail</label>
                  <input type="email" name="emailUsuario" id="id-email-usuario" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100" value="<?php echo htmlspecialchars( $dadosUsuario["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim Email do usuario-->

              <?php if( $dadosUsuario["isPessoa"] == 1 ){ ?>
              <!--setor do usuario-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-setor-hidden" value="<?php echo htmlspecialchars( $dadosUsuario["setor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <label for="id-setor-usuario">Setor *</label>
                  <select class="form-control select2" name="setorUsuario" id="id-setor-usuario" required>
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
                  <input type="text" name="funcaoUsuario" id="id-funcao-usuario" class="form-control" placeholder="Função" maxlength="45" required onkeyup="validarCaracter(this, 1)" onblur="digitoRg()" value="<?php echo htmlspecialchars( $dadosUsuario["funcao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim funcao do usuario-->
              <?php } ?>
            </div>
            <!--Fim Row-->

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
                  <input type="text" name="cepUsuario" id="id-cep-usuario" class="form-control" placeholder="_____-___" value="<?php echo htmlspecialchars( $dadosUsuario["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim Numero cep-->

              <!--Rua usuario-->
              <div class="col-md-5">
                <div class="form-group">
                  <label for="id-rua-usuario">Rua</label>
                  <input type="text" name="ruaUsuario" id="id-rua-usuario" class="form-control" placeholder="Digite o nome da rua da usuario" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $dadosUsuario["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim Rua usuario-->

              <!--Bairro usuario-->
              <div class="col-md-5">
                <div class="form-group">
                  <label for="id-bairro-usuario">Bairro</label>
                  <input type="text" name="bairroUsuario" id="id-bairro-usuario" class="form-control" placeholder="Digite o nome do bairro da usuario" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $dadosUsuario["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                  <input type="number" name="numeroUsuario" id="id-numero-usuario" class="form-control" placeholder="Numero da casa" min="0" value="<?php echo htmlspecialchars( $dadosUsuario["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim Numero usuario--> 

              <!--Estado usuario-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-estado-hidden" value="<?php echo htmlspecialchars( $dadosUsuario["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                  <input type="text" name="cidadeUsuario" id="id-cidade-usuario" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $dadosUsuario["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <!--Fim Cidade usuario-->

              <!--Complemento usuario-->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="id-complemento-usuario">Complemento</label>
                  <input type="text" name="complementoUsuario" id="id-complemento-usuario" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $dadosUsuario["complemento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                  <input type="hidden" id="id-nivel-hidden" value="<?php echo htmlspecialchars( $dadosUsuario["nivelAcesso"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <label for="id-nivel-usuario">Nivel de Acesso *</label>
                  <select class="form-control select2" name="nivelUsuario" id="id-nivel-usuario" required>
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
                <input type="text" name="usernameUsuario" id="id-username-usuario" class="form-control" placeholder="Usuário" maxlength="45" onkeyup="validarCaracter(this, 2)" onblur="digitoRg()" value="<?php echo htmlspecialchars( $dadosUsuario["user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
              <!--Fim Usuario-->
            </div>
            <!--Fim Row-->

            <br><hr><br>

            <!--Inicio Row-->
            <div class="row">
              <div class="col-md-12">
                <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Editar">
                <a href="/usuarios-detalhe/<?php echo htmlspecialchars( $dadosUsuario["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary pull-left margin">Voltar</a> 
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
    let sexoHidden = document.getElementById("id-sexo-hidden").value;
    let setorHidden = document.getElementById("id-setor-hidden").value;
    let estadoHidden = document.getElementById("id-estado-hidden").value;
    let nivelHidden = document.getElementById("id-nivel-hidden").value;

    let sexo = document.getElementById("id-sexo-usuario").value = sexoHidden;
    let setor = document.getElementById("id-setor-usuario").value = setorHidden;
    let estado = document.getElementById("id-estado-usuario").value = estadoHidden;
    let nivelAcesso = document.getElementById("id-nivel-usuario").value = nivelHidden;  
  }

  function digitoRg()
  {
    let nome = document.getElementById("id-nome-usuario");
    let cpf = document.getElementById("id-cpf-usuario");
    let setor = document.getElementById("id-setor-usuario");
    let funcao = document.getElementById("id-funcao-usuario");
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
          nome.value != "" && 
          cpf.value != "" && 
          setor.value != "" && 
          funcao.value != "" && 
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
          nome.value != "" && 
          cpf.value != "" && 
          setor.value != "" && 
          funcao.value != "" && 
          usuario.value != "" && 
          nivelAcesso.value != ""
        ) 
        {
          botaoEnviar.disabled = false;
        }
    }
  }

</script>