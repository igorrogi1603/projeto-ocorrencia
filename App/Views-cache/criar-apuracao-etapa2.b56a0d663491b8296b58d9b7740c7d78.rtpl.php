<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Criar Apuração</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Criar Apuração</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao-->
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <!--Inicio Progresso-->
        <div class="row">
          <div class="col-md-12">
            <h3 class="titulo-h3">Etapa 2</h3>
            <div class="progress" style="border: 1px solid #ddd;">
              <div class="progress-bar" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <!--Fim Progresso-->

        <br><br>

        <!--Inicio Form-->
        <form action="/criar-apuracao-etapa3" method="post">

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
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id-nome-vitima">Nome Completo da Vítima *</label>
                    <input type="text" name="nome-vitima" id="id-nome-vitima" class="form-control" placeholder="Digite o nome aqui" maxlength="70" required>
                  </div>
                </div>
                <!--Fim Nome Completo da Vitima-->
              </div>
              <!-- /.row -->

              <!--Inicio row-->
              <div class="row">
                <!--Sexo-->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id-sexo-vitima">Sexo</label>
                    <select class="form-control select2" name="sexo-vitima" id="id-sexo-vitima">
                      <option value="masculino">Masculino</option>
                      <option value="feminino">Feminino</option>
                    </select>
                  </div>
                </div>
                <!--Fim Sexo-->

                <!--CPF-->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id-cpf-vitima">CPF</label>
                    <input type="text" name="cpf-vitima" id="id-cpf-vitima" class="form-control" placeholder="___.___.___-__">
                  </div>
                </div>
                <!--Fim CPF-->

                <!--Celular Vitima-->
                <div class="col-md-4">
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
         
          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" value="Enviar">
              <a href="/criar-apuracao-etapa1" class="btn btn-primary pull-left margin">Voltar</a>
            </div>            
          </div>
          <!--Fim Row-->
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

<script type="text/javascript">
  /*Responsavel da Vitima
  ---------------------------*/
  var div1;
  var div2;

  window.onload = function(){
    div1 = document.getElementById("div-responsavel-vitima-sim");
    div2 = document.getElementById("div-responsavel-vitima-nao");

    var divsim = document.getElementById("isresponsavel-vitima-sim");
    divsim.onclick = mostrarDiv1;

    var divnao = document.getElementById("isresponsavel-vitima-nao");
    divnao.onclick = mostrarDiv2;

    div2.classList.add("escondido");
  }

  function mostrarDiv1(){
    div1.classList.remove("escondido");
    div2.classList.add("escondido");
  }

  function mostrarDiv2(){
    div2.classList.remove("escondido");
    div1.classList.add("escondido");
  }

</script>