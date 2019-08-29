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
        <!--Row-->
        <div class="row">
          <!--Nome do usuario-->
          <div class="col-md-6">
            <div class="form-group">
              <label for="id-nome-usuario">Nome Completo do Usuario *</label>
              <input type="text" name="nome-usuario" id="id-nome-usuario" class="form-control" placeholder="Digite o nome aqui" maxlength="70" required>
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
                  <input type="text" id="id-data-nasc-usuario" class="form-control" placeholder="__/__/____">
                </div>
              </div>
            </div>
            <!--Data de Nascimento da usuario-->

            <!--Sexo-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-sexo-usuario">Sexo</label>
                <select class="form-control select2" name="sexo-usuario" id="id-sexo-usuario">
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
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
                <label for="id-cpf-usuario">CPF</label>
                <input type="text" name="cpf-usuario" id="id-cpf-usuario" class="form-control" placeholder="___.___.___-__">
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-rg-usuario">RG</label>
                <input type="text" name="rg-usuario" id="id-rg-usuario" class="form-control" placeholder="__.___.___">
              </div>
            </div>
            <!--Fim RG-->

            <!--RG digito verificador-->
            <div class="col-md-1">
              <div class="form-group">
                <label for="id-rg-digito-usuario">Digito</label>
                <input type="text" name="rg-digito-usuario" id="id-rg-digito-usuario" class="form-control" maxlength="1">
              </div>
            </div>
            <!--Fim RG digito verificador-->

            <!--Telefone Fixo usuario-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-usuario">Telefone Fixo</label>
                <input type="text" name="telfixo-usuario" id="id-telfixo-usuario" class="form-control" placeholder="____-____">
              </div>
            </div>
            <!--Telefone Fixo usuario-->

            <!--Celular usuario-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-usuario">Celular</label>
                <input type="text" name="celular-usuario" id="id-celular-usuario" class="form-control" placeholder="_____-____">
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
                <input type="text" name="email-usuario" id="id-email-usuario" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100">
              </div>
            </div>
            <!--Fim Email do usuario-->

            <!--setor do usuario-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-setor-usuario">Setor</label>
                <select class="form-control select2" name="setor-usuario" id="id-setor-usuario">
                  <option value="secretaria-saude">Secretaria da Saude</option>
                  <option value="administracao">Administração</option>
                </select>
              </div>
            </div>
            <!--Fim Setor do usuario-->

            <!--Funcao do usuario-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-funcao-usuario">Função</label>
                <input type="text" name="funcao-usuario" id="id-funcao-usuario" class="form-control" placeholder="Função" maxlength="45">
              </div>
            </div>
            <!--Fim funcao do usuario-->
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
            <!--Rua usuario-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-rua-usuario">Rua</label>
                <input type="text" name="rua-usuario" id="id-rua-usuario" class="form-control" placeholder="Digite o nome da rua da usuario" maxlength="100">
              </div>
            </div>
            <!--Fim Rua usuario-->

            <!--Bairro usuario-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-bairro-usuario">Bairro</label>
                <input type="text" name="bairro-usuario" id="id-bairro-usuario" class="form-control" placeholder="Digite o nome do bairro da usuario" maxlength="100">
              </div>
            </div>
            <!--Fim Bairro usuario-->   

            <!--Numero usuario-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-numero-usuario">Numero</label>
                <input type="number" name="numero-usuario" id="id-numero-usuario" class="form-control" placeholder="Numero da casa" max="6" min="0">
              </div>
            </div>
            <!--Fim Numero usuario-->         
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Estado usuario-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-estado-usuario">Estado</label>
                <select class="form-control select2" name="estado-usuario" id="id-estado-usuario">
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espirito Santos</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP" selected>São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                </select>
              </div>
            </div>
            <!--Fim Estado usuario-->

            <!--Cidade usuario-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-cidade-usuario">Cidade</label>
                <input type="text" name="cidade-usuario" id="id-cidade-usuario" class="form-control" placeholder="Cidade">
              </div>
            </div>
            <!--Fim Cidade usuario-->

            <!--Complemento usuario-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-usuario">Complemento</label>
                <input type="text" name="complemento-usuario" id="id-complemento-usuario" class="form-control" placeholder="Complemento" maxlength="100">
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
                <label for="id-nivel-usuario">Nivel de Acesso</label>
                <select class="form-control select2" name="nivel-usuario" id="id-nivel-usuario">
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
              <label for="id-username-usuario">Usuário</label>
              <input type="text" name="username-usuario" id="id-username-usuario" class="form-control" placeholder="Usuário" maxlength="45">
            </div>
            <!--Fim Usuario-->
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Senha-->
            <div class="col-md-6">
              <label for="id-senha-usuario">Senha</label>
              <a data-teste="popover" data-toggle="popover" data-placement="right" data-trigger="hover" title="<strong>Informação</strong>" 
                data-content="<strong>Senha deve conter:</strong><br>
                              - Letras Maiúsculas<br>
                              - Letras Minúsculas<br>
                              - Um Simbúlo<br>
                              - Um Número">
                <i class="fa fa-question-circle"></i>
              </a>
              <input type="password" name="senha-usuario" id="id-senha-usuario" class="form-control" placeholder="Senha">
            </div>
            <!--Fim Senha-->
            
            <!--Confirmacao Senha-->
            <div class="col-md-6">
              <label for="id-confirmacao-senha-usuario">Confirmar Senha</label>
              <input type="password" name="confirmacao-senha-usuario" id="id-confirmacao-senha-usuario" class="form-control" placeholder="Confirmação da Senha">
            </div>
            <!--Fim Confirmacao Senha-->
          </div>
          <!--Fim Row-->

          <br><hr><br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" value="Cadastrar">
            </div>            
          </div>
          <!--Fim Row-->
        
      </div>
      <!--Fim box body-->
    </div>
    <!--Fim box apuracao-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->