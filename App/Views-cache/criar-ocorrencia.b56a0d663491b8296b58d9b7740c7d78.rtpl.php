<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Criar Ocorrência</h1>

    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Criar Ocorrência</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Inicio Formulario-->
    <form action="/ocorrencia-enviada" method="POST">
      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <!--              Box Dadados da Vitima                       -->
      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Dados da Vítima</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!--Nome Completo da Vitima-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-vitima">Nome Completo da Vítima *</label>
                <input type="text" name="nome-vitima" id="id-nome-vitima" class="form-control" placeholder="Digite o nome aqui" maxlength="70" required>
              </div>
            </div>
            <!--Fim Nome Completo da Vitima-->

            <!--Data de Nascimento da Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label>Data de Nascimento *</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="id-data-nasc-vitima" class="form-control" placeholder="__/__/____" required>
                </div>
              </div>
            </div>
            <!--Data de Nascimento da Vitima-->

            <!--Sexo-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-sexo-vitima">Sexo</label>
                <select class="form-control select2" name="sexo-vitima" id="id-sexo-vitima">
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
                </select>
              </div>
            </div>
            <!--Fim Sexo-->
          </div>
          <!-- /.row -->

          <!--Inicio row-->
          <div class="row">
            <!--CPF-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-cpf-vitima">CPF</label>
                <input type="text" name="cpf-vitima" id="id-cpf-vitima" class="form-control" placeholder="___.___.___-__">
              </div>
            </div>
            <!--Fim CPF-->

            <!--RG-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-rg-vitima">RG</label>
                <input type="text" name="rg-vitima" id="id-rg-vitima" class="form-control" placeholder="__.___.___">
              </div>
            </div>
            <!--Fim RG-->

            <!--Telefone Fixo Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-vitima">Telefone Fixo</label>
                <input type="text" name="telfixo-vitima" id="id-telfixo-vitima" class="form-control" placeholder="____-____">
              </div>
            </div>
            <!--Telefone Fixo Vitima-->

            <!--Celular Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-vitima">Celular</label>
                <input type="text" name="celular-vitima" id="id-celular-vitima" class="form-control" placeholder="_____-____">
              </div>
            </div>
            <!--Fim Celular Vitima-->
          </div>
          <!--Fim row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Upload CPF-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-up-cpf-vitima">Upload CPF</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-cpf-vitima" id="id-up-cpf-vitima" class="arquivo" style="display: none;">
                  <input type="text" name="up-cpf-file-vitima" id="id-up-cpf-file-vitima" class="file" placeholder="Upload CPF" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-cpf-vitima" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload CPF-->

            <!--Upload RG-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-up-rg-vitima">Upload RG</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-rg-vitima" id="id-up-rg-vitima" class="arquivo" style="display: none;">
                  <input type="text" name="up-rg-file-vitima" id="id-up-rg-file-vitima" class="file" placeholder="Upload RG" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-rg-vitima" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload RG-->

            <!--Upload Certidao de Nascimento-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-up-cnasc-vitima">Upload Certidão de Nascimento</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-cnasc-vitima" id="id-up-cnasc-vitima" class="arquivo" style="display: none;">
                  <input type="text" name="up-cnasc-file-vitima" id="id-up-cnasc-file-vitima" class="file" placeholder="Upload Certidão" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-cnasc-vitima" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload Certidao de Nascimento-->
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Pai da Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-pai-vitima">Nome Completo do Pai da Vítima</label>
                <input type="text" name="pai-vitima" id="id-pai-vitima" class="form-control" placeholder="Digite o nome do pai da vitima" maxlength="70">
              </div>
            </div>
            <!--Fim Pai da Vitima-->

            <!--Mae da Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-mae-vitima">Nome Completo da Mãe da Vítima</label>
                <input type="text" name="mae-vitima" id="id-mae-vitima" class="form-control" placeholder="Digite o nome do mae da vitima" maxlength="70">
              </div>
            </div>
            <!--Fim Mae da Vitima-->

            <!--Inicio Radio-->
            <div class="col-md-4">
              <div class="form-group">
                <label>Os pais são os Responsaveis?</label><br>
                <label class="container-radio">Sim
                  <input type="radio" name="isresponsavel-vitima" id="isresponsavel-vitima-sim" class="minimal" value="1" checked>
                  <span class="checkmark"></span>
                </label>
                <label class="container-radio">Não
                  <input type="radio" name="isresponsavel-vitima" id="isresponsavel-vitima-nao" class="minimal" value="0">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <!--Fim Radio-->
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div id="div-responsavel-vitima-sim"></div>
          <div class="row" id="div-responsavel-vitima-nao">
            <!--Reponsavel da Vitima-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-responsavel-vitima">Nome Completo do Responsavel da Vítima</label>
                <input type="text" name="responsavel-vitima" id="id-responsavel-vitima" class="form-control" placeholder="Digite o nome do responsavel da vitima" maxlength="70">
              </div>
            </div>
            <!--Fim Resposavel da Vitima-->

            <!--CPF do Responsavel da Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-cpf-responsavel-vitima">CPF</label>
                <input type="text" name="cpf-responsavel-vitima" id="id-cpf-responsavel-vitima" class="form-control" placeholder="___.___.___-__">
              </div>
            </div>
            <!--Fim CPF do Responsavel da Vitima-->

            <!--Celular Responsavel Vitima-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-responsavel-vitima">Celular</label>
                <input type="text" name="celular-responsavel-vitima" id="id-celular-responsavel-vitima" class="form-control" placeholder="_____-____">
              </div>
            </div>
            <!--Fim Celular Responsavel Vitima-->
          </div>
          <!--Fim Row-->

          <div class="row">
            <div class="col-md-12">
              <h4>Endereço da Vítima</h4>
              <hr>
            </div>
          </div>

          <!--Inicio Row-->
          <div class="row">
            <!--Rua Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-rua-vitima">Rua</label>
                <input type="text" name="rua-vitima" id="id-rua-vitima" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100">
              </div>
            </div>
            <!--Fim Rua Vitima-->

            <!--Bairro Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-bairro-vitima">Bairro</label>
                <input type="text" name="bairro-vitima" id="id-bairro-vitima" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100">
              </div>
            </div>
            <!--Fim Bairro Vitima-->   

            <!--Numero Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-numero-vitima">Numero</label>
                <input type="number" name="numero-vitima" id="id-numero-vitima" class="form-control" placeholder="Numero da casa" max="6" min="0">
              </div>
            </div>
            <!--Fim Numero Vitima-->         
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Estado Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-estado-vitima">Estado</label>
                <input type="text" name="estado-vitima" id="id-estado-vitima" class="form-control" value="SP" disabled="disabled">
              </div>
            </div>
            <!--Fim Estado Vitima-->

            <!--Cidade Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-cidade-vitima">Cidade</label>
                <input type="text" name="cidade-vitima" id="id-cidade-vitima" class="form-control" value="Nova Campina" disabled="disabled">
              </div>
            </div>
            <!--Fim Cidade Vitima-->

            <!--Complemento Vitima-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-vitima">Complemento</label>
                <input type="text" name="complemento-vitima" id="id-complemento-vitima" class="form-control" placeholder="Complemento" maxlength="100">
              </div>
            </div>
            <!--Fim Complemento Vitima-->
          </div>
          <!--Fim Row-->

        </div>
        <!--Fim box-body -->
        
      </div>
      <!--Fim Box Dados da Vitima-->

      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <!--              Box Dadados do Agressor                     -->
      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Dados do Agressor</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!--Nome Completo do Agressor-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-nome-agressor">Nome Completo do Agressor</label>
                <input type="text" name="nome-agressor" id="id-nome-agressor" class="form-control" placeholder="Digite o nome aqui" maxlength="70">
              </div>
            </div>
            <!--Fim Nome Completo da Agressor-->

            <!--Data de Nascimento da Agressor-->
            <div class="col-md-2">
              <div class="form-group">
                <label>Data de Nascimento</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="id-data-nasc-agressor" class="form-control" placeholder="__/__/____" onchange="menorMaior()">
                </div>
              </div>
            </div>
            <!--Data de Nascimento da Agressor-->

            <!--Sexo Agressor-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="id-sexo-agressor">Sexo</label>
                <select class="form-control select2" name="sexo-agressor" id="id-sexo-agressor">
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
                </select>
              </div>
            </div>
            <!--Fim Sexo Agressor-->

            <!--Nao sabe quem e o agressor-->
            <div class="col-md-2">
              <div class="form-group">
                <label>Sabe quem é o agressor?</label><br>
                <label class="container-radio">Sim
                  <input type="radio" name="conhece-agressor" id="conhece-agressor-sim" class="minimal" value="1" checked>
                  <span class="checkmark"></span>
                </label>
                <label class="container-radio">Não
                  <input type="radio" name="conhece-agressor" id="conhece-agressor-nao" class="minimal" value="0">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <!--Fim Nao sabe quem e o agressor-->
          </div>
          <!-- /.row -->

          <!--Inicio Row-->
          <div id="div-conhece-agressor-sim"></div>
          <div class="row" id="div-conhece-agressor-nao">
            <!--Conhece-Agressor-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-descricao-agressor">Descrição do agressor</label>
                <input type="text" name="descricao-agressor" id="id-descricao-agressor" class="form-control" placeholder="Digite a descrição do agressor" maxlength="200">
              </div>
            </div>
            <!--Fim Conhece-Agressor-->
          </div>
          <!--Fim Row-->

          <!--Inicio row-->
          <div class="row">
            <!--CPF Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-cpf-agressor">CPF</label>
                <input type="text" name="cpf-agressor" id="id-cpf-agressor" class="form-control" placeholder="___.___.___-__">
              </div>
            </div>
            <!--Fim CPF Agressor-->

            <!--RG Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-rg-agressor">RG</label>
                <input type="text" name="rg-agressor" id="id-rg-agressor" class="form-control" placeholder="__.___.___">
              </div>
            </div>
            <!--Fim RG Agressor-->

            <!--Telefone Fixo Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-telfixo-agressor">Telefone Fixo</label>
                <input type="text" name="telfixo-agressor" id="id-telfixo-agressor" class="form-control" placeholder="____-____">
              </div>
            </div>
            <!--Telefone Fixo Agressor-->

            <!--Celular Agressor-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-celular-agressor">Celular</label>
                <input type="text" name="celular-agressor" id="id-celular-agressor" class="form-control" placeholder="_____-____">
              </div>
            </div>
            <!--Fim Celular Agressor-->
          </div>
          <!--Fim row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Upload CPF Agressor-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-up-cpf-agressor">Upload CPF</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-cpf-agressor" id="id-up-cpf-agressor" class="arquivo" style="display: none;">
                  <input type="text" name="up-cpf-file-agressor" id="id-up-cpf-file-agressor" class="file" placeholder="Upload CPF" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-cpf-agressor" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload CPF Agressor-->

            <!--Upload RG Agressor-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id-up-rg-agressor">Upload RG</label><br>
                <div class="input-group input-group-sm">
                  <input type="file" name="up-rg-agressor" id="id-up-rg-agressor" class="arquivo" style="display: none;">
                  <input type="text" name="up-rg-file-agressor" id="id-up-rg-file-agressor" class="file" placeholder="Upload RG" readonly="readonly">
                  <span class="input-group-btn">
                    <input type="button" class="btn" id="id-btn-up-rg-agressor" value="SELECIONAR">
                  </span>
                </div>
              </div>
            </div>
            <!--Fim Upload RG Agressor-->
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div id="div-responsavel-agressor-maior"></div>
          <div id="div-responsavel-agressor-menor">
            <div class="row">
              <div class="col-md-12">
                <h4>Agressor é menor de idade</h4>
                <hr>
              </div>
            </div>
            <div class="row">
              <!--Reponsavel da Agressor-->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id-responsavel-agressor">Nome Completo do Responsavel do Agressor</label>
                  <input type="text" name="responsavel-agressor" id="id-responsavel-agressor" class="form-control" placeholder="Digite o nome do responsavel do agressor" maxlength="70">
                </div>
              </div>
              <!--Fim Resposavel da Agressor-->

              <!--CPF do Responsavel da Agressor-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-cpf-responsavel-agressor">CPF</label>
                  <input type="text" name="cpf-responsavel-agressor" id="id-cpf-responsavel-agressor" class="form-control" placeholder="___.___.___-__">
                </div>
              </div>
              <!--Fim CPF do Responsavel da Agressor-->

              <!--Celular Responsavel Agressor-->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="id-celular-responsavel-agressor">Celular</label>
                  <input type="text" name="celular-responsavel-agressor" id="id-celular-responsavel-agressor" class="form-control" placeholder="_____-____">
                </div>
              </div>
              <!--Fim Celular Responsavel Agressor-->
            </div>
            <!--Fim Row-->
          </div>

          <div class="row">
            <div class="col-md-12">
              <h4>Endereço do Agressor</h4>
              <hr>
            </div>
          </div>

          <!--Inicio Row-->
          <div class="row">
            <!--Rua Agressor-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-rua-agressor">Rua</label>
                <input type="text" name="rua-agressor" id="id-rua-agressor" class="form-control" placeholder="Digite o nome da rua da agressor" maxlength="100">
              </div>
            </div>
            <!--Fim Rua Agressor-->

            <!--Bairro Agressor-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-bairro-agressor">Bairro</label>
                <input type="text" name="bairro-agressor" id="id-bairro-agressor" class="form-control" placeholder="Digite o nome do bairro da agressor" maxlength="100">
              </div>
            </div>
            <!--Fim Bairro Agressor-->   

            <!--Numero Agressor-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-numero-agressor">Numero</label>
                <input type="number" name="numero-agressor" id="id-numero-agressor" class="form-control" placeholder="Numero da casa" max="6" min="0">
              </div>
            </div>
            <!--Fim Numero Agressor-->         
          </div>
          <!--Fim Row-->

          <!--Inicio Row-->
          <div class="row">
            <!--Estado Agressor-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-estado-agressor">Estado</label>
                <input type="text" name="estado-agressor" id="id-estado-agressor" class="form-control" value="SP" disabled="disabled">
              </div>
            </div>
            <!--Fim Estado Agressor-->

            <!--Cidade Agressor-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-cidade-agressor">Cidade</label>
                <input type="text" name="cidade-agressor" id="id-cidade-agressor" class="form-control" value="Nova Campina" maxlength="50">
              </div>
            </div>
            <!--Fim Cidade Agressor-->

            <!--Complemento Agressor-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id-complemento-agressor">Complemento</label>
                <input type="text" name="complemento-agressor" id="id-complemento-agressor" class="form-control" placeholder="Complemento" maxlength="100">
              </div>
            </div>
            <!--Fim Complemento Agressor-->
          </div>
          <!--Fim Row-->

        </div>
        <!--Fim box-body -->
        
      </div>
      <!--Fim Box Dados da Agressor-->

      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <!--              Box Dadados da Ocorrencia                   -->
      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Dados da Ocorrência</h3>

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
                <label for="id-tipo-da-ocorrencia">Tipo da Ocorrência</label>
                <input type="text" name="tipo-da-ocorrencia" id="id-tipo-da-ocorrencia" class="form-control" maxlength="100">
              </div>
            </div>
            <!--Fim Tipo da Ocorrencia-->

            <!--Descricao da Ocorrencia-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="id-descricao-da-ocorrencia">Descrição da Ocorrência</label>
                <textarea name="descricao-da-ocorrencia" id="id-descricao-da-ocorrencia" class="form-control" rows="10"></textarea>
              </div>
            </div>
            <!--Fim Descricao da Ocorrencia-->            
          </div>
          <!--Fim Row-->
        </div>
        <!--Fim box-body -->
      </div>
      <!--Fim Box Dados da Ocorrencia-->

      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <!--                    Box Submit                            -->
      <!-------------------------------------------------------------->
      <!-------------------------------------------------------------->
      <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-6">
              <input type="submit" class="btn btn-success btn-block btn-lg" value="Cadastrar" style="height: 40px; font-size: 20px;">
            </div>
            <div class="col-md-6">
              <a href="#" class="btn btn-danger btn-block btn-lg" style="height: 40px; font-size: 20px;">Cancelar</a>
            </div>   
          </div>
          <!--Fim Row-->
        </div>
        <!--Fim box-body -->
      </div>
      <!--Fim Box Dados da Agressor-->      

    </form>
    <!--Fim Formulario-->

  </section>
  <!--Fim content -->
</div>
<!--Fim content-wrapper -->

<script type="text/javascript">
  /*Responsavel da Vitima
  ---------------------------*/
  var div1;
  var div2;
  var divAgressorMaior;
  var divAgressorMenor;

  window.onload = function(){
    div1 = document.getElementById("div-responsavel-vitima-sim");
    div2 = document.getElementById("div-responsavel-vitima-nao");

    divAgressorMaior = document.getElementById("div-responsavel-agressor-maior");
    divAgressorMenor = document.getElementById("div-responsavel-agressor-menor");

    divConheceAgressorSim = document.getElementById("div-conhece-agressor-sim");
    divConheceAgressorNao = document.getElementById("div-conhece-agressor-nao");

    var divsim = document.getElementById("isresponsavel-vitima-sim");
    divsim.onclick = mostrarDiv1;

    var divnao = document.getElementById("isresponsavel-vitima-nao");
    divnao.onclick = mostrarDiv2;

    var conheceAgressorSim = document.getElementById("conhece-agressor-sim");
    conheceAgressorSim.onclick = mostrarDivConheceAgressor1;

    var conheceAgressorNao = document.getElementById("conhece-agressor-nao");
    conheceAgressorNao.onclick = mostrarDivConheceAgressor2;

    div2.classList.add("escondido");

    divAgressorMenor.classList.add("escondido");

    divConheceAgressorNao.classList.add("escondido");
  }

  function mostrarDiv1(){
    div1.classList.remove("escondido");
    div2.classList.add("escondido");
  }

  function mostrarDiv2(){
    div2.classList.remove("escondido");
    div1.classList.add("escondido");
  }

  function mostrarDivConheceAgressor1(){
    divConheceAgressorSim.classList.remove("escondido");
    divConheceAgressorNao.classList.add("escondido");
  }

  function mostrarDivConheceAgressor2(){
    divConheceAgressorSim.classList.add("escondido");
    divConheceAgressorNao.classList.remove("escondido");  
  }

  /*Responsavel do Agressor
  ---------------------------*/
  function menorMaior() {
    let dataHoje = new Date();
    nascAgressor = document.getElementById("id-data-nasc-agressor").value;

    let parts = nascAgressor.split('/');
    nascAgressor = new Date(parts[2], parts[1] - 1, parts[0]);

    let diferencaData = dataHoje - nascAgressor;

    let msEmAnos = diferencaData / 3.1540000000000;

    let SmsEmAnos = msEmAnos.toString();

    let resultString = SmsEmAnos.substring(0, 2);

    let resultInt = parseInt(resultString);

    if (resultInt < 18) {
      divAgressorMaior.classList.add("escondido");
      divAgressorMenor.classList.remove("escondido");
    } else {
      divAgressorMaior.classList.remove("escondido");
      divAgressorMenor.classList.add("escondido");
    }
  }

</script>