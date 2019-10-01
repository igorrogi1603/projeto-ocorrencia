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
        <h3 class="box-title">Responsavel</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="/ocorrencia-responsavel-vitima-editar/<?php echo htmlspecialchars( $vitima["0"]["idVitimasApuracao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $vitima["0"]["idOcorrencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $vitima["0"]["idPessoaVitima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

          <!--Row-->
          <div class="row">
            <!--Nome do responsavel-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-responsavel">Nome Completo *</label>
                <input type="text" name="nomeResponsavel" id="id-nome-responsavel" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $vitima["0"]["nomeResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim Nome do vitima-->

            <!--Inicio Radio-->
            <div class="col-md-3">
              <div class="form-group">
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
                <label for="id-responsavel-text-outro">Outro</label>
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
                <input type="text" name="cpfResponsavel" id="id-cpf-responsavel" class="form-control" placeholder="___.___.___-__" value="<?php echo htmlspecialchars( $vitima["0"]["cpfResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-rg-responsavel">RG</label>
                <input type="text" name="rgResponsavel" id="id-rg-responsavel" class="form-control" placeholder="__.___.___" onblur="digitoRg()" value="<?php echo htmlspecialchars( $vitima["0"]["rgResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim RG-->

            <!--RG digito verificador-->
            <div class="col-md-1 divBordaVermelhaVerde">
              <div class="form-group">
                <label for="id-rg-digito-responsavel">Digito</label>
                <input type="text" name="rgDigitoResponsavel" id="id-rg-digito-responsavel" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)" value="<?php echo htmlspecialchars( $vitima["0"]["rgResponsavelDigito"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                    <input type="text" name="dataNascResponsavel" id="id-data-nasc-responsavel" class="form-control" placeholder="__/__/____" value="<?php echo htmlspecialchars( $vitima["0"]["dataNascResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
              </div>
              <!--Data de Nascimento da vitima-->

              <!--Sexo-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-sexo-hidden-responsavel" value="<?php echo htmlspecialchars( $vitima["0"]["sexoResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                <input type="email" name="emailResponsavel" id="id-email-responsavel" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100" value="<?php echo htmlspecialchars( $vitima["0"]["emailResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Email-->

            <!--Telefone Fixo vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-responsavel">Telefone Fixo</label>
                <input type="text" name="telFixoResponsavel" id="id-telfixo-responsavel" class="form-control" placeholder="____-____" value="<?php echo htmlspecialchars( $vitima["0"]["fixoResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Telefone Fixo vitima-->

            <!--Celular vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-responsavel">Celular</label>
                <input type="text" name="celularResponsavel" id="id-celular-responsavel" class="form-control" placeholder="_____-____" value="<?php echo htmlspecialchars( $vitima["0"]["celularResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                <input type="text" name="cepResponsavel" id="id-cep-responsavel" class="form-control" placeholder="_____-___" value="<?php echo htmlspecialchars( $vitima["0"]["cepResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Numero cep-->

            <!--Rua vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-rua-responsavel">Rua</label>
                <input type="text" name="ruaResponsavel" id="id-rua-responsavel" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $vitima["0"]["ruaResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Rua vitima-->

            <!--Bairro vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-bairro-responsavel">Bairro</label>
                <input type="text" name="bairroResponsavel" id="id-bairro-responsavel" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $vitima["0"]["bairroResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                <input type="number" name="numeroResponsavel" id="id-numero-responsavel" class="form-control" placeholder="Numero da casa" min="0" value="<?php echo htmlspecialchars( $vitima["0"]["numeroResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Numero vitima--> 

            <!--Estado vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden" id="id-estado-hidden-responsavel" value="<?php echo htmlspecialchars( $vitima["0"]["estadoResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
                <input type="text" name="cidadeResponsavel" id="id-cidade-responsavel" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $vitima["0"]["cidadeResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Cidade vitima-->

            <!--Complemento vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-responsavel">Complemento</label>
                <input type="text" name="complementoResponsavel" id="id-complemento-responsavel" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)" value="<?php echo htmlspecialchars( $vitima["0"]["complementoResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Complemento vitima-->
          </div>
          <!--Fim Row-->          
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

    <!--Box Detalhes-->
    <div id="id-div-pai-sim">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pai</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!--Row-->
          <div class="row">
            <!--Nome do vitima-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-nome-pai">Nome Completo *</label>
                <input type="text" name="nomePai" id="id-nome-pai" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" value="" required>
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
                <label for="id-cpf-pai">CPF *</label>
                <input type="text" name="cpfPai" id="id-cpf-pai" class="form-control" placeholder="___.___.___-__" value="" required>
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-rg-pai">RG</label>
                <input type="text" name="rgPai" id="id-rg-pai" class="form-control" placeholder="__.___.___" onblur="digitoRg()" value="">
              </div>
            </div>
            <!--Fim RG-->

            <!--RG digito verificador-->
            <div class="col-md-1 divBordaVermelhaVerde">
              <div class="form-group">
                <label for="id-rg-digito-pai">Digito</label>
                <input type="text" name="rgDigitoPai" id="id-rg-digito-pai" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)" value="">
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
                    <input type="text" name="dataNascPai" id="id-data-nasc-pai" class="form-control" placeholder="__/__/____" value="">
                  </div>
                </div>
              </div>
              <!--Data de Nascimento da vitima-->

              <!--Sexo-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-sexo-hidden-pai" value="">
                  <label for="id-sexo-pai">Sexo</label>
                  <select class="form-control select2" name="sexoPai" id="id-sexo-pai">
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
                <label for="id-email-pai">E-mail</label>
                <input type="email" name="emailPai" id="id-email-pai" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100" value="">
              </div>
            </div>
            <!--Fim Email-->

            <!--Telefone Fixo vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-pai">Telefone Fixo</label>
                <input type="text" name="telFixoPai" id="id-telfixo-pai" class="form-control" placeholder="____-____" value="">
              </div>
            </div>
            <!--Telefone Fixo vitima-->

            <!--Celular vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-pai">Celular</label>
                <input type="text" name="celularPai" id="id-celular-pai" class="form-control" placeholder="_____-____" value="">
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
                <label for="id-cep-pai">CEP</label>
                <input type="text" name="cepPai" id="id-cep-pai" class="form-control" placeholder="_____-___" value="">
              </div>
            </div>
            <!--Fim Numero cep-->

            <!--Rua vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-rua-pai">Rua</label>
                <input type="text" name="ruaPai" id="id-rua-pai" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="">
              </div>
            </div>
            <!--Fim Rua vitima-->

            <!--Bairro vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-bairro-pai">Bairro</label>
                <input type="text" name="bairroPai" id="id-bairro-pai" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="">
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
                <label for="id-numero-pai">Numero</label>
                <input type="number" name="numeroPai" id="id-numero-pai" class="form-control" placeholder="Numero da casa" min="0" value="">
              </div>
            </div>
            <!--Fim Numero vitima--> 

            <!--Estado vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden" id="id-estado-hidden-pai" value="">
                <label for="id-estado-pai">Estado</label>
                <select class="form-control select2" name="estadoPai" id="id-estado-pai">
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
                <label for="id-cidade-pai">Cidade</label>
                <input type="text" name="cidadePai" id="id-cidade-pai" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)" value="">
              </div>
            </div>
            <!--Fim Cidade vitima-->

            <!--Complemento vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-pai">Complemento</label>
                <input type="text" name="complementoPai" id="id-complemento-pai" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)" value="">
              </div>
            </div>
            <!--Fim Complemento vitima-->
          </div>
          <!--Fim Row-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->
    </div>

    <!--Box Detalhes-->
    <div id="id-div-mae-sim">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Mãe</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!--Row-->
          <div class="row">
            <!--Nome do vitima-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-nome-mae">Nome Completo *</label>
                <input type="text" name="nomeMae" id="id-nome-mae" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" value="" required>
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
                <label for="id-cpf-mae">CPF *</label>
                <input type="text" name="cpfMae" id="id-cpf-mae" class="form-control" placeholder="___.___.___-__" value="" required>
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-rg-mae">RG</label>
                <input type="text" name="rgMae" id="id-rg-mae" class="form-control" placeholder="__.___.___" onblur="digitoRg()" value="">
              </div>
            </div>
            <!--Fim RG-->

            <!--RG digito verificador-->
            <div class="col-md-1 divBordaVermelhaVerde">
              <div class="form-group">
                <label for="id-rg-digito-mae">Digito</label>
                <input type="text" name="rgDigitoMae" id="id-rg-digito-mae" class="form-control" maxlength="1" onblur="digitoRg()" onkeyup="validarCaracter(this, 2)" value="">
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
                    <input type="text" name="dataNascMae" id="id-data-nasc-mae" class="form-control" placeholder="__/__/____" value="">
                  </div>
                </div>
              </div>
              <!--Data de Nascimento da vitima-->

              <!--Sexo-->
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" id="id-sexo-hidden-mae" value="">
                  <label for="id-sexo-mae">Sexo</label>
                  <select class="form-control select2" name="sexoMae" id="id-sexo-mae">
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
                <label for="id-email-mae">E-mail</label>
                <input type="email" name="emailMae" id="id-email-mae" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100" value="">
              </div>
            </div>
            <!--Fim Email-->

            <!--Telefone Fixo vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-mae">Telefone Fixo</label>
                <input type="text" name="telFixoMae" id="id-telfixo-mae" class="form-control" placeholder="____-____" value="">
              </div>
            </div>
            <!--Telefone Fixo vitima-->

            <!--Celular vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-mae">Celular</label>
                <input type="text" name="celularMae" id="id-celular-mae" class="form-control" placeholder="_____-____" value="">
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
                <label for="id-cep-mae">CEP</label>
                <input type="text" name="cepMae" id="id-cep-mae" class="form-control" placeholder="_____-___" value="">
              </div>
            </div>
            <!--Fim Numero cep-->

            <!--Rua vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-rua-mae">Rua</label>
                <input type="text" name="ruaMae" id="id-rua-mae" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="">
              </div>
            </div>
            <!--Fim Rua vitima-->

            <!--Bairro vitima-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="id-bairro-mae">Bairro</label>
                <input type="text" name="bairroMae" id="id-bairro-mae" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)" value="">
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
                <label for="id-numero-mae">Numero</label>
                <input type="number" name="numeroMae" id="id-numero-mae" class="form-control" placeholder="Numero da casa" min="0" value="">
              </div>
            </div>
            <!--Fim Numero vitima--> 

            <!--Estado vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden" id="id-estado-hidden-mae" value="">
                <label for="id-estado-mae">Estado</label>
                <select class="form-control select2" name="estadoMae" id="id-estado-mae">
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
                <label for="id-cidade-mae">Cidade</label>
                <input type="text" name="cidadeMae" id="id-cidade-mae" class="form-control" placeholder="Cidade" onkeyup="validarCaracter(this, 1)" value="">
              </div>
            </div>
            <!--Fim Cidade vitima-->

            <!--Complemento vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-mae">Complemento</label>
                <input type="text" name="complementoMae" id="id-complemento-mae" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)" value="">
              </div>
            </div>
            <!--Fim Complemento vitima-->
          </div>
          <!--Fim Row-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->
    </div> 

    <!--Box Detalhes-->
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" id="botaoEnviar" value="Editar">
              <a href="#" class="btn btn-primary pull-left margin">Voltar</a>
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

var divPaiSim;
var divMaeSim;

window.onload = function()
{
  let sexoHiddenResponsavel = document.getElementById("id-sexo-hidden-responsavel").value;
  let estadoHiddenResposanvel = document.getElementById("id-estado-hidden-responsavel").value;
  let sexoHiddenPai = document.getElementById("id-sexo-hidden-pai").value;
  let estadoHiddenPai = document.getElementById("id-estado-hidden-pai").value;
  let sexoHiddenMae = document.getElementById("id-sexo-hidden-mae").value;
  let estadoHiddenMae = document.getElementById("id-estado-hidden-mae").value;

  estadoHiddenResposanvel = estadoHiddenResposanvel.toLowerCase();
  estadoHiddenPai = estadoHiddenPai.toLowerCase();
  estadoHiddenMae = estadoHiddenMae.toLowerCase();

  let sexoResponsavel = document.getElementById("id-sexo-responsavel").value = sexoHiddenResponsavel;  
  let estadoResponsavel = document.getElementById("id-estado-responsavel").value = estadoHiddenResposanvel;
  let sexoPai = document.getElementById("id-sexo-pai").value = sexoHiddenPai;  
  let estadoPai = document.getElementById("id-estado-pai").value = estadoHiddenPai;
  let sexoMae = document.getElementById("id-sexo-mae").value = sexoHiddenMae;  
  let estadoMae = document.getElementById("id-estado-mae").value = estadoHiddenMae;

  //////////////////////////////////////////////////////////////////////////////////////////////
  //Mostrar divs
  divPaiSim = document.getElementById("id-div-pai-sim");
  //var divPaiNao = document.getElementById("id-div-pai-nao");
  divMaeSim = document.getElementById("id-div-mae-sim");
  //var divMaeNao = document.getElementById("id-div-mae-nao");

  var radioPai = document.getElementById('id-responsavel-pai');
  radioPai.onclick = mostra1;

  var radioMae = document.getElementById('id-responsavel-mae');
  radioMae.onclick = mostra2;

  var radioOutro = document.getElementById('id-responsavel-outro');
  radioOutro.onclick = mostra3;

  divPaiSim.classList.add("escondido");
  divMaeSim.classList.add("escondido");
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
  divPaiSim.classList.add("escondido");
  divMaeSim.classList.remove("escondido");
}

function mostra2()
{
  divPaiSim.classList.remove("escondido");
  divMaeSim.classList.add("escondido"); 
}

function mostra3()
{
  divPaiSim.classList.remove("escondido");
  divMaeSim.classList.remove("escondido");
}

</script>