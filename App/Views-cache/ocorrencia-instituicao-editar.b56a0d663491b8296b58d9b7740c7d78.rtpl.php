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
                <label for="id-nome-agressor">Nome Completo da Instituição *</label>
                <input type="text" name="nomeAgressor" id="id-nome-agressor" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" value="<?php echo htmlspecialchars( $agressor["0"]["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
              </div>
            </div>
            <!--Fim Nome do Agressor-->

            <!--CNPJ-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-cnpj-instituicao">CNPJ *</label>
                <input type="text" name="cnpjAgressor" id="id-cnpj-instituicao" class="form-control" placeholder="___.___.___-__" value="<?php echo htmlspecialchars( $agressor["0"]["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim CNPJ-->
          </div>
          <!--Fim Row-->

          <!--Inicio row-->
          <div class="row">
            <!--Email do Agressor-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-email-agressor">E-mail</label>
                <input type="email" name="emailAgressor" id="id-email-agressor" class="form-control" placeholder="Digite o e-mail aqui" maxlength="100" value="<?php echo htmlspecialchars( $agressor["0"]["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!--Fim Email do Agressor-->

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