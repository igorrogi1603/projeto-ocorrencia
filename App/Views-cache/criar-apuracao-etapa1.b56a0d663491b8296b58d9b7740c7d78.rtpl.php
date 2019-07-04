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
            <h3 class="titulo-h3">Etapa 1</h3>
            <div class="progress" style="border: 1px solid #ddd;">
              <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <!--Fim Progresso-->

        <br><br>

        <!--Inicio Form-->
        <form action="/criar-apuracao-etapa2" method="post">

          <div class="row">
            <div class="col-md-12">
              <h3 class="titulo-h3">Dados da Apuração</h3>
            </div>
          </div>

          <hr>
          <br>

          <!--Inicio Row-->
          <div class="row">
            <!--QTD Vitimas-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="id-qtd-vitima">Quantas Vítimas são?</label>
                <input type="text" name="qtd-vitima" id="id-qtd-vitima" class="form-control" maxlength="2" pattern="([0-9]{2})" placeholder="Ex: 01, 02, 10" required>
              </div>
            </div>
            <!--Fim QTD Vitimas-->

            <!--Mostrar se a quantidade de vitimas for maior que 1-->
            <!--Inicio familia-->
            <div class="col-md-6">
              <div class="form-group">
                <label>Todas as Vítimas são da mesma familía?</label><br>
                <label class="container-radio">Sim
                  <input type="radio" name="mesma-familia-vitima" id="mesma-familia-vitima-sim" class="minimal" value="1" checked>
                  <span class="checkmark"></span>
                </label>
                <label class="container-radio">Não
                  <input type="radio" name="mesma-familia-vitima" id="mesma-familia-vitima-nao" class="minimal" value="0">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <!--Fim familia-->
          </div>
          <!--Fim Row-->

          <br>

          <!--Inicio Row-->
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary pull-right margin" value="Próximo">
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