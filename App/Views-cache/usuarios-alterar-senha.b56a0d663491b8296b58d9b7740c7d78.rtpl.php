<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Alterar Senha Usuário</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Alterar Senha Usuário</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box apuracao--> 
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Alterar Senha</h3>
      </div>

      <!-- /.box-header -->
      <div class="box-body">

        <form action="/usuarios-alterar-senha/senha/<?php echo htmlspecialchars( $idUsuario, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

            <!--Inicio Row-->
            <div class="row">
              <!--Senha-->
              <div class="col-md-6">
                <label for="id-senha-usuario">Nova Senha * </label>
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
    let botaoEnviar = document.getElementById("botaoEnviar");

    botaoEnviar.setAttribute("disabled", false);
  }
 
  function confirmarSenha()
  {
    let senha = document.getElementById("id-senha-usuario");
    let confirmarSenha = document.getElementById("id-confirmacao-senha-usuario");
    let botaoEnviar = document.getElementById("botaoEnviar");
    let senhaIncorreta = document.getElementById("id-senha-incorreta");

    if (senha.value === confirmarSenha.value && senha.value != "" && confirmarSenha != "") {
      confirmarSenha.classList.remove("borda-vermelha");
      confirmarSenha.classList.add("borda-verde");

      senhaIncorreta.classList.add("esconder");

      if (
          senha.value != "" && 
          confirmarSenha.value != ""
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

</script>